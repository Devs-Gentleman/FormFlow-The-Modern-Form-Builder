@extends('layouts.app')

@section('content')
<div class="min-h-screen p-6 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Forms -->
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-gray-500 text-sm font-semibold">Total Forms</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalForms }}</p>
        </div>

        <!-- Total Responses -->
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-gray-500 text-sm font-semibold">Total Responses</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalResponses }}</p>
        </div>

        <!-- Recent Activity Count -->
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-gray-500 text-sm font-semibold">Recent Activity</h2>
            <p class="text-3xl font-bold mt-2">{{ $recentActivity->count() }}</p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 mb-8">
        <a href="{{ route('forms.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">Create New Form</a>
        <a href="{{ route('forms.index') }}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg shadow hover:bg-gray-300 transition">View All Forms</a>
        <a href="{{ route('settings.index') }}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg shadow hover:bg-gray-300 transition">Settings</a>
    </div>

    <!-- Recent Forms List -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Recent Forms</h2>
        <ul class="divide-y divide-gray-200">
            @forelse($recentActivity as $form)
                <li class="py-3 flex justify-between items-center">
                    <span class="font-medium">{{ $form->title }}</span>
                    <span class="text-gray-400 text-sm">{{ $form->created_at->format('d M, Y') }}</span>
                </li>
            @empty
                <li class="py-3 text-gray-500">No recent forms created.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
