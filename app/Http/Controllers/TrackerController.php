<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipApplication;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TrackerController extends Controller
{
    public function index(): View
    {
        $applications = ScholarshipApplication::where('user_id', auth()->id())
            ->orderByDesc('applied_at')->orderByDesc('updated_at')->get();

        return view('pages.tracker', compact('applications'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'scholarship_id' => ['required', 'string', 'max:120'],
            'scholarship_title' => ['required', 'string', 'max:200'],
            'provider' => ['nullable', 'string', 'max:200'],
            'scholarship_type' => ['nullable', 'string', 'max:80'],
            'applied_at' => ['nullable', 'date', 'before_or_equal:today'],
        ]);

        $application = ScholarshipApplication::firstOrCreate(
            ['user_id' => auth()->id(), 'scholarship_id' => $validated['scholarship_id']],
            [
                'scholarship_title' => $validated['scholarship_title'],
                'provider' => $validated['provider'] ?? null,
                'scholarship_type' => $validated['scholarship_type'] ?? null,
                'applied_at' => $validated['applied_at'] ?? now()->toDateString(),
                'status' => 'applied',
            ]
        );

        if (! $application->wasRecentlyCreated) {
            return response()->json(['message' => 'This scholarship is already in your tracker.', 'application' => $application], 409);
        }

        return response()->json(['message' => 'Scholarship added to your tracker.', 'application' => $application], 201);
    }

    public function update(Request $request, ScholarshipApplication $application): RedirectResponse
    {
        abort_unless($application->user_id === auth()->id(), 403);

        $data = $request->validate([
            'status' => ['required', Rule::in(['applied', 'passed', 'failed'])],
            'applied_at' => ['required', 'date', 'before_or_equal:today'],
            'application_reference' => ['nullable', 'string', 'max:150'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $application->update($data);

        return to_route('dashboard.tracker')->with('status', 'Tracker details updated.');
    }

    public function destroy(ScholarshipApplication $application): RedirectResponse
    {
        abort_unless($application->user_id === auth()->id(), 403);
        $application->delete();

        return to_route('dashboard.tracker')->with('status', 'Scholarship removed from your tracker.');
    }
}
