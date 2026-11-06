<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_users' => User::where('is_admin', false)->count(),
            'total_scholarships' => Scholarship::count(),
            'published_scholarships' => Scholarship::published()->count(),
            'draft_scholarships' => Scholarship::where('is_published', false)->count(),
            'total_applications' => ScholarshipApplication::count(),
            'passed_applications' => ScholarshipApplication::where('status', 'passed')->count(),
        ];

        $recentUsers = User::where('is_admin', false)
            ->latest()
            ->limit(5)
            ->get();

        $recentScholarships = Scholarship::latest()
            ->limit(5)
            ->get();

        return view('pages.admin.dashboard', compact('stats', 'recentUsers', 'recentScholarships'));
    }
}
