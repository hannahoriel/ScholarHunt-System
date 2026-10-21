<?php

namespace App\Http\Controllers;

use App\Support\ScholarshipData;
use Illuminate\Contracts\View\View;

class FeedController extends Controller
{
    public function index(): View
    {
        return view('pages.feed', [
            'scholarships' => ScholarshipData::all(),
            'types' => ScholarshipData::TYPES,
        ]);
    }
}
