<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use Illuminate\Contracts\View\View;

class FeedController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $scholarships = Scholarship::published()
            ->orderBy('deadline')
            ->get()
            ->map(fn (Scholarship $s) => [
                'id' => (string) $s->id,
                'title' => $s->title,
                'provider' => $s->provider,
                'type' => $s->type,
                'levels' => $s->levels ?? [],
                'tags' => $s->tags ?? '',
                'summary' => $s->summary,
                'benefits' => $s->benefits,
                'eligibility' => $s->eligibility,
                'opens' => $s->opens?->toDateString(),
                'deadline' => $s->deadline?->toDateString(),
                'link' => $s->link,
                'application_link' => $s->application_link,
                'requirements' => $s->requirements ?? [],
            ])
            ->all();

        $trackedScholarshipIds = ScholarshipApplication::where('user_id', $user?->id)
            ->pluck('scholarship_id')
            ->all();

        return view('pages.feed', [
            'scholarships' => $scholarships,
            'types' => Scholarship::TYPES,
            'trackedScholarshipIds' => $trackedScholarshipIds,
        ]);
    }
}
