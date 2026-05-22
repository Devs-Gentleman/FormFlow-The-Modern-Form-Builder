<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Metrics for current user
        $totalForms = Form::where('user_id', $user->id)->count();

        $totalResponses = Response::whereHas('form', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();

        // Fetch recent forms WITH public_link
        $recentActivity = Form::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get(['id', 'title', 'created_at', 'public_link']); // <--- This was the missing piece

        // Send data to Vue dashboard page
        return Inertia::render('Dashboard', [
            'totalForms' => $totalForms,
            'totalResponses' => $totalResponses,
            'recentActivity' => $recentActivity,
        ]);
    }
}