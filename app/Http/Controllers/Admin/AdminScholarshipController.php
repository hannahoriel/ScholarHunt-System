<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminScholarshipController extends Controller
{
    public function index(Request $request): View
    {
        $query = Scholarship::query()->latest();

        if ($search = $request->string('q')->trim()->toString()) {
            $query->search($search);
        }

        if ($type = $request->string('type')->trim()->toString()) {
            $query->where('type', $type);
        }

        if ($status = $request->string('status')->trim()->toString()) {
            match ($status) {
                'published' => $query->where('is_published', true),
                'draft' => $query->where('is_published', false),
                default => null,
            };
        }

        $scholarships = $query->paginate(15)->withQueryString();

        return view('pages.admin.scholarships.index', [
            'scholarships' => $scholarships,
            'types' => Scholarship::TYPES,
            'filters' => $request->only(['q', 'type', 'status']),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.scholarships.form', [
            'scholarship' => new Scholarship,
            'types' => Scholarship::TYPES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateScholarship($request);
        $validated['slug'] = $this->makeSlug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['is_published'] = $request->boolean('is_published');
        $validated['levels'] = $request->input('levels', []);
        $validated['requirements'] = $this->parseRequirements($request->input('requirements_raw', ''));

        Scholarship::create($validated);

        return to_route('admin.scholarships.index')
            ->with('success', 'Scholarship created successfully.');
    }

    public function edit(Scholarship $scholarship): View
    {
        return view('pages.admin.scholarships.form', [
            'scholarship' => $scholarship,
            'types' => Scholarship::TYPES,
        ]);
    }

    public function update(Request $request, Scholarship $scholarship): RedirectResponse
    {
        $validated = $this->validateScholarship($request, $scholarship);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['levels'] = $request->input('levels', []);
        $validated['requirements'] = $this->parseRequirements($request->input('requirements_raw', ''));

        $scholarship->update($validated);

        return to_route('admin.scholarships.index')
            ->with('success', 'Scholarship updated successfully.');
    }

    public function destroy(Scholarship $scholarship): RedirectResponse
    {
        $scholarship->delete();

        return to_route('admin.scholarships.index')
            ->with('success', 'Scholarship deleted.');
    }

    public function togglePublish(Scholarship $scholarship): RedirectResponse
    {
        $scholarship->update(['is_published' => ! $scholarship->is_published]);

        $label = $scholarship->is_published ? 'published' : 'set to draft';

        return back()->with('success', "Scholarship {$label}.");
    }

    /** ---------------------------------------------------
     *  Helpers
     * ---------------------------------------------------*/

    /**
     * @return array<string, mixed>
     */
    private function validateScholarship(Request $request, ?Scholarship $existing = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'provider' => ['required', 'string', 'max:200'],
            'type' => ['required', 'string', Rule::in(array_keys(Scholarship::TYPES))],
            'levels' => ['required', 'array', 'min:1'],
            'levels.*' => ['in:shs,college'],
            'tags' => ['nullable', 'string', 'max:500'],
            'summary' => ['required', 'string', 'max:2000'],
            'benefits' => ['nullable', 'string', 'max:2000'],
            'eligibility' => ['nullable', 'string', 'max:2000'],
            'opens' => ['nullable', 'date'],
            'deadline' => ['nullable', 'date'],
            'link' => ['nullable', 'url', 'max:500'],
            'application_link' => ['nullable', 'url', 'max:500'],
        ]);
    }

    private function makeSlug(string $title): string
    {
        $base = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title));
        $base = trim($base, '-');
        $slug = substr($base, 0, 100);
        $original = $slug;
        $i = 2;

        while (Scholarship::where('slug', $slug)->exists()) {
            $slug = $original.'-'.$i;
            $i++;
        }

        return $slug;
    }

    /**
     * @return array<int, string>
     */
    private function parseRequirements(string $raw): array
    {
        return array_values(
            array_filter(
                array_map('trim', explode("\n", $raw)),
                fn (string $line) => $line !== ''
            )
        );
    }
}
