<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipApplication;
use App\Support\ScholarshipData;
use Illuminate\Contracts\View\View;

class FeedController extends Controller
{
    public function index(): View
    {
        return view('pages.feed', [
            'scholarships' => ScholarshipData::all(),
            'types' => ScholarshipData::TYPES,
            'trackedScholarshipIds' => ScholarshipApplication::where('user_id', auth()->id())->pluck('scholarship_id')->all(),
        ]);
    }
}
