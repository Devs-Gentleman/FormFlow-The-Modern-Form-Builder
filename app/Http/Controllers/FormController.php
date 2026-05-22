<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function index()
    {
        return Inertia::render('Forms/Index', [
            'forms' => Form::where('user_id', Auth::id())->latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Forms/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'json_structure' => 'required|array',
            'json_structure.*.id' => 'required|string',
            'json_structure.*.type' => 'required|in:text,textarea,email,number,date,time,radio,checkbox,file,rating', 
            'json_structure.*.label' => 'required|string|max:500',
            'json_structure.*.helpText' => 'nullable|string',
            'json_structure.*.required' => 'boolean',
            'json_structure.*.options' => 'array|nullable',
            'status' => 'in:draft,published',
            'expires_at' => 'nullable|date|after:now',
            'identifier_field' => 'nullable|string',
        ]);

        Form::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'json_structure' => json_encode($validated['json_structure']),
            'status' => $validated['status'] ?? 'draft',
            'expires_at' => $validated['expires_at'],
            'public_link' => Str::uuid(),
            'identifier_field' => $validated['identifier_field'] ?? null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Form created successfully!');
    }

    public function results(Form $form)
    {
        if ($form->user_id !== Auth::id()) {
            abort(403);
        }

        $form->load(['responses' => function ($query) {
            $query->latest();
        }]);

        // Convert responses to ensure response_json is properly cast as array
        $responses = $form->responses->map(function($response) {
            return [
                'id' => $response->id,
                'form_id' => $response->form_id,
                'response_json' => is_string($response->response_json) 
                    ? json_decode($response->response_json, true) 
                    : $response->response_json,
                'created_at' => $response->created_at,
                'updated_at' => $response->updated_at,
            ];
        });

        return Inertia::render('Forms/Results', [
            'form' => $form,
            'responses' => $responses
        ]);
    }

    // --- PUBLIC ACCESS LOGIC ---

    public function publicShow($public_link)
    {
        $form = Form::where('public_link', $public_link)->firstOrFail();

        // 1. Check if manually closed (Draft)
        if ($form->status !== 'published') {
            return Inertia::render('Forms/Error', [
                'title' => 'Form Closed',
                'message' => 'The creator has stopped accepting responses for this form.'
            ]);
        }

        // 2. Check if deadline passed
        if ($form->expires_at && now()->gt($form->expires_at)) {
            return Inertia::render('Forms/Error', [
                'title' => 'Deadline Passed',
                'message' => 'This form expired on ' . $form->expires_at->format('M d, Y \a\t h:i A')
            ]);
        }

        return Inertia::render('Forms/PublicView', [
            'form' => $form
        ]);
    }

    public function submit(Request $request, $public_link)
    {
        $form = Form::where('public_link', $public_link)->firstOrFail();
        
        // Security: Double-check expiration/status on submit
        if ($form->status !== 'published' || ($form->expires_at && now()->gt($form->expires_at))) {
            return redirect()->back()->with('error', 'Form is closed or expired.');
        }

        // Get form structure
        $formStructure = json_decode($form->json_structure, true);
        
        // Build dynamic validation rules based on form structure
        // Create a mapping from normalized keys to original labels
        $labelMap = [];
        $rules = [];
        
        foreach ($formStructure as $field) {
            $label = $field['label'];
            $normalizedLabel = str_replace(' ', '_', $label); // HTTP converts spaces to underscores
            $labelMap[$normalizedLabel] = $label; // Map back to original
            
            $fieldRules = [];
            
            // Required check
            if ($field['required'] ?? false) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }
            
            // Type-specific validation
            switch ($field['type']) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
                case 'time':
                    $fieldRules[] = 'date_format:H:i'; 
                    break;
                case 'file':
                    $fieldRules[] = 'file';
                    $fieldRules[] = 'max:10240'; // 10MB max
                    $fieldRules[] = 'mimes:pdf,doc,docx,jpg,jpeg,png,txt';
                    break;
                case 'rating':
                    $fieldRules[] = 'integer';
                    $fieldRules[] = 'between:1,5';
                    break;
                case 'checkbox':
                    $fieldRules[] = 'array';
                    break;
            }
            
            // Validate using the NORMALIZED key (with underscores)
            $rules[$normalizedLabel] = $fieldRules;
        }
        
        // Validate the request using normalized keys
        $validated = $request->validate($rules);
        
        // --- Process and Store Data ---
        $responseData = [];
        
        foreach ($formStructure as $field) {
            $label = $field['label']; // Original label with spaces
            $normalizedLabel = str_replace(' ', '_', $label); // Normalized key from request
            
            if ($field['type'] === 'file') {
                // The file input is available in $request->file($normalizedLabel)
                if ($request->hasFile($normalizedLabel)) { 
                    $file = $request->file($normalizedLabel);
                    $path = $file->store('form-uploads', 'public');
                    
                    // Store file path using ORIGINAL label
                    $responseData[$label] = $path; 
                }
            } else {
                // Get value from validated (which uses normalized keys)
                $value = $validated[$normalizedLabel] ?? null;
                
                // Always include the field in the response using ORIGINAL label
                $responseData[$label] = $value;
            }
        }

        // 3. Save the Response using ORIGINAL labels as keys
        $form->responses()->create([
            'response_json' => json_encode($responseData),
        ]);

        return redirect()->back()->with('success', 'Thank you! Your response has been saved.');
    }

    public function destroy(Form $form)
    {
        // Check if the user owns this form
        if ($form->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Delete all responses associated with this form
        $form->responses()->delete();

        // Delete the form itself
        $form->delete();

        return redirect()->route('dashboard')->with('success', 'Form deleted successfully.');
    }
}