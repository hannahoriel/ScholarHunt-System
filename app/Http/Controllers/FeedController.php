<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\ScholarshipApplication;
=======
>>>>>>> origin/master
use App\Support\ScholarshipData;
use Illuminate\Contracts\View\View;

class FeedController extends Controller
{
    public function index(): View
    {
        return view('pages.feed', [
            'scholarships' => ScholarshipData::all(),
            'types' => ScholarshipData::TYPES,
<<<<<<< HEAD
            'trackedScholarshipIds' => ScholarshipApplication::where('user_id', auth()->id())->pluck('scholarship_id')->all(),
=======
>>>>>>> origin/master
        ]);
    }
}
