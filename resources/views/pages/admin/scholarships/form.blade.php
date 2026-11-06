@extends('pages.admin.app')

@section('title', $scholarship->exists ? 'Edit Scholarship' : 'Add Scholarship')
@section('topbar-title', $scholarship->exists ? 'Edit Scholarship' : 'Add Scholarship')

@section('content')
@php
    $isEditing = $scholarship->exists;
    $formAction = $isEditing
        ? route('admin.scholarships.update', $scholarship)
        : route('admin.scholarships.store');
    $requirementsRaw = implode("\n", $scholarship->requirements ?? []);
@endphp

<div class="a-page-head">
    <div>
        <h1>{{ $isEditing ? 'Edit Scholarship' : 'Add New Scholarship' }}</h1>
        <p>{{ $isEditing ? 'Update scholarship details and manage its visibility.' : 'Fill in the details below to add a scholarship to the platform.' }}</p>
    </div>
    <a href="{{ route('admin.scholarships.index') }}" class="btn btn-secondary">
        <svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Back to list
    </a>
</div>

@if ($errors->any())
    <div class="flash flash-error" role="alert">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg>
        <div>
            <strong>Please fix the following errors:</strong>
            <ul style="margin-top:6px;padding-left:18px;font-size:13px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form method="POST" action="{{ $formAction }}" novalidate>
    @csrf
    @if ($isEditing) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;align-items:start;">

        {{-- Main fields --}}
        <div style="display:flex;flex-direction:column;gap:20px;">

            <div class="a-card">
                <div class="a-card-head"><h2>Basic Information</h2></div>
                <div class="a-card-body">
                    <div class="form-grid">
                        <div class="field form-full">
                            <label for="title">Scholarship Title <span class="req">*</span></label>
                            <input id="title" name="title" type="text" class="input"
                                value="{{ old('title', $scholarship->title) }}"
                                placeholder="e.g. DOST-SEI Undergraduate Scholarship"
                                required>
                            @error('title') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label for="provider">Provider / Organization <span class="req">*</span></label>
                            <input id="provider" name="provider" type="text" class="input"
                                value="{{ old('provider', $scholarship->provider) }}"
                                placeholder="e.g. Department of Science and Technology"
                                required>
                            @error('provider') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label for="type">Scholarship Type <span class="req">*</span></label>
                            <select id="type" name="type" class="select" required>
                                <option value="">Select type…</option>
                                @foreach ($types as $key => $label)
                                    <option value="{{ $key }}" @selected(old('type', $scholarship->type) === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label>Education Level <span class="req">*</span></label>
                            <div style="display:flex;gap:20px;margin-top:4px;">
                                @php $selectedLevels = old('levels', $scholarship->levels ?? []); @endphp
                                <label class="checkbox-row">
                                    <input type="checkbox" name="levels[]" value="shs"
                                        @checked(in_array('shs', $selectedLevels))>
                                    Senior High School
                                </label>
                                <label class="checkbox-row">
                                    <input type="checkbox" name="levels[]" value="college"
                                        @checked(in_array('college', $selectedLevels))>
                                    College
                                </label>
                            </div>
                            @error('levels') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field form-full">
                            <label for="summary">Summary <span class="req">*</span></label>
                            <textarea id="summary" name="summary" class="textarea" rows="3"
                                placeholder="Brief description shown on the scholarship card…"
                                required>{{ old('summary', $scholarship->summary) }}</textarea>
                            @error('summary') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field form-full">
                            <label for="benefits">Benefits</label>
                            <textarea id="benefits" name="benefits" class="textarea" rows="3"
                                placeholder="What the scholar receives (tuition, stipend, allowance…)">{{ old('benefits', $scholarship->benefits) }}</textarea>
                        </div>
                        <div class="field form-full">
                            <label for="eligibility">Eligibility</label>
                            <textarea id="eligibility" name="eligibility" class="textarea" rows="3"
                                placeholder="Who can apply…">{{ old('eligibility', $scholarship->eligibility) }}</textarea>
                        </div>
                        <div class="field form-full">
                            <label for="requirements_raw">Requirements</label>
                            <textarea id="requirements_raw" name="requirements_raw" class="textarea" rows="5"
                                placeholder="One requirement per line:&#10;PSA Birth Certificate&#10;Form 138 / Report Card&#10;Certificate of Good Moral Character">{{ old('requirements_raw', $requirementsRaw) }}</textarea>
                            <span class="field-hint">Enter each requirement on its own line.</span>
                        </div>
                        <div class="field form-full">
                            <label for="tags">Search Tags</label>
                            <input id="tags" name="tags" type="text" class="input"
                                value="{{ old('tags', $scholarship->tags) }}"
                                placeholder="stem engineering science merit manila (space-separated keywords)">
                            <span class="field-hint">Keywords that help students find this scholarship via search.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="a-card">
                <div class="a-card-head"><h2>Links &amp; Dates</h2></div>
                <div class="a-card-body">
                    <div class="form-grid">
                        <div class="field">
                            <label for="opens">Opens</label>
                            <input id="opens" name="opens" type="date" class="input"
                                value="{{ old('opens', $scholarship->opens?->format('Y-m-d')) }}">
                        </div>
                        <div class="field">
                            <label for="deadline">Deadline</label>
                            <input id="deadline" name="deadline" type="date" class="input"
                                value="{{ old('deadline', $scholarship->deadline?->format('Y-m-d')) }}">
                        </div>
                        <div class="field form-full">
                            <label for="link">Info Page URL</label>
                            <input id="link" name="link" type="url" class="input"
                                value="{{ old('link', $scholarship->link) }}"
                                placeholder="https://…">
                        </div>
                        <div class="field form-full">
                            <label for="application_link">Direct Application URL</label>
                            <input id="application_link" name="application_link" type="url" class="input"
                                value="{{ old('application_link', $scholarship->application_link) }}"
                                placeholder="https://… (optional, only if a direct portal exists)">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Sidebar panel --}}
        <div style="display:flex;flex-direction:column;gap:16px;">
            <div class="a-card">
                <div class="a-card-head"><h2>Publish</h2></div>
                <div class="a-card-body" style="display:flex;flex-direction:column;gap:14px;">
                    <label class="checkbox-row">
                        <input type="checkbox" name="is_published" value="1"
                            @checked(old('is_published', $scholarship->is_published))>
                        <div>
                            <strong style="font-size:14px;">Publish to students</strong>
                            <div style="font-size:12px;color:var(--muted);">Visible in the student scholarship feed</div>
                        </div>
                    </label>
                    <hr style="border:none;border-top:1px solid var(--line);">
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                        <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2Z"/><path d="M17 21v-8H7v8M7 3v5h8"/></svg>
                        {{ $isEditing ? 'Save Changes' : 'Create Scholarship' }}
                    </button>
                    @if ($isEditing)
                        <a href="{{ route('admin.scholarships.index') }}" class="btn btn-secondary" style="width:100%;justify-content:center;">
                            Discard Changes
                        </a>
                        <form method="POST" action="{{ route('admin.scholarships.destroy', $scholarship) }}"
                            data-confirm="Permanently delete '{{ addslashes($scholarship->title) }}'?">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;">
                                <svg viewBox="0 0 24 24"><path d="M3 6h18M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                                Delete Scholarship
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            @if ($isEditing)
            <div class="a-card">
                <div class="a-card-head"><h2>Details</h2></div>
                <div class="a-card-body" style="font-size:13px;color:var(--muted);display:flex;flex-direction:column;gap:8px;">
                    <div><strong>Created</strong><br>{{ $scholarship->created_at->format('M d, Y') }}</div>
                    <div><strong>Last Updated</strong><br>{{ $scholarship->updated_at->format('M d, Y g:i A') }}</div>
                    @if ($scholarship->creator)
                        <div><strong>Added by</strong><br>{{ $scholarship->creator->full_name }}</div>
                    @endif
                </div>
            </div>
            @endif
        </div>

    </div>
</form>

@push('styles')
<style>
    @media (max-width: 900px) {
        div[style*="grid-template-columns:2fr 1fr"] { grid-template-columns: 1fr !important; }
    }
</style>
@endpush
@endsection
