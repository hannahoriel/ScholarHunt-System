<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::where('is_admin', false)
            ->withCount('scholarshipApplications')
            ->latest();

        if ($search = $request->string('q')->trim()->toString()) {
            $like = '%'.mb_strtolower($search).'%';
            $query->where(function ($q) use ($like): void {
                $q->whereRaw('LOWER(first_name) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(surname) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(email) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(school_name) LIKE ?', [$like]);
            });
        }

        if ($level = $request->string('level')->trim()->toString()) {
            $query->where('education_level', $level);
        }

        $users = $query->paginate(20)->withQueryString();

        return view('pages.admin.users.index', [
            'users' => $users,
            'filters' => $request->only(['q', 'level']),
        ]);
    }

    public function show(User $user): View
    {
        abort_if($user->is_admin, 404);

        $applications = ScholarshipApplication::where('user_id', $user->id)
            ->latest('applied_at')
            ->get();

        /** Match published scholarships to the user's education level and show ones not yet tracked. */
        $matchedScholarships = Scholarship::published()
            ->get()
            ->filter(fn (Scholarship $s) => $s->isForLevel($user->education_level))
            ->reject(fn (Scholarship $s) => $applications->contains('scholarship_id', (string) $s->id))
            ->values();

        return view('pages.admin.users.show', compact('user', 'applications', 'matchedScholarships'));
    }

    public function destroy(User $user, Request $request): RedirectResponse
    {
        abort_if($user->is_admin, 403);
        abort_if($user->id === auth()->id(), 403);

        $user->delete();

        return to_route('admin.users.index')
            ->with('success', 'User account deleted.');
    }
}
