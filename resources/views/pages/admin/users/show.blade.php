@extends('pages.admin.app')

@section('title', $user->full_name)
@section('topbar-title', 'Student Profile')

@section('content')
<div class="a-page-head">
    <div style="display:flex;align-items:center;gap:14px;">
        <div style="width:52px;height:52px;border-radius:50%;background:#EEF2FF;color:var(--accent);display:grid;place-items:center;font:800 18px 'Manrope',sans-serif;flex:none;">
            {{ mb_substr($user->first_name, 0, 1) }}{{ mb_substr($user->surname, 0, 1) }}
        </div>
        <div>
            <h1 style="margin:0;">{{ $user->full_name }}</h1>
            <p style="margin:0;">{{ $user->email }} · Joined {{ $user->created_at->format('M d, Y') }}</p>
        </div>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            Back to Students
        </a>
        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
            data-confirm="Permanently delete {{ addslashes($user->full_name) }}'s account and all their applications?">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <svg viewBox="0 0 24 24"><path d="M3 6h18M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                Delete Account
            </button>
        </form>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">

    {{-- Personal info --}}
    <div class="a-card">
        <div class="a-card-head">
            <h2>Personal Information</h2>
            <span class="badge {{ $user->education_level === 'college' ? 'badge-teal' : 'badge-indigo' }}">
                {{ strtoupper($user->education_level) }}
            </span>
        </div>
        <div class="a-card-body">
            <dl style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="detail-item">
                    <dt>Full Name</dt>
                    <dd>{{ $user->full_name }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Sex</dt>
                    <dd>{{ ucfirst($user->sex) }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Birthday</dt>
                    <dd>{{ $user->birthday->format('M d, Y') }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Age</dt>
                    <dd>{{ $user->age }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Contact</dt>
                    <dd>{{ $user->contact_number }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Email</dt>
                    <dd style="overflow-wrap:anywhere;">{{ $user->email }}</dd>
                </div>
                <div class="detail-item" style="grid-column:1/-1;">
                    <dt>Home Address</dt>
                    <dd>{{ $user->address_street }}, {{ $user->address_barangay }}, {{ $user->address_city }}, {{ $user->address_province }} {{ $user->address_zip }}</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- Education --}}
    <div class="a-card">
        <div class="a-card-head"><h2>Education</h2></div>
        <div class="a-card-body">
            <dl style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="detail-item" style="grid-column:1/-1;">
                    <dt>School</dt>
                    <dd>{{ $user->school_name }}</dd>
                </div>
                <div class="detail-item" style="grid-column:1/-1;">
                    <dt>School Address</dt>
                    <dd>{{ $user->school_address }}</dd>
                </div>
                @if ($user->education_level === 'college')
                    <div class="detail-item">
                        <dt>Year Level</dt>
                        <dd>{{ $user->college_year ? 'Year '.$user->college_year : '—' }}</dd>
                    </div>
                    <div class="detail-item">
                        <dt>Course</dt>
                        <dd>{{ $user->college_course ?? '—' }}</dd>
                    </div>
                @else
                    <div class="detail-item">
                        <dt>Grade</dt>
                        <dd>{{ $user->shs_grade ? 'Grade '.$user->shs_grade : '—' }}</dd>
                    </div>
                    <div class="detail-item">
                        <dt>Strand</dt>
                        <dd>{{ $user->shs_strand ?? '—' }}</dd>
                    </div>
                @endif
            </dl>
        </div>
    </div>
</div>

{{-- Application summary stats --}}
@php
    $totalApplications = $applications->count();
    $passedCount  = $applications->where('status', 'passed')->count();
    $failedCount  = $applications->where('status', 'failed')->count();
    $appliedCount = $applications->where('status', 'applied')->count();
@endphp
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px;">
    <div class="stat-card" style="padding:16px 18px;">
        <div class="stat-card-value" style="font-size:22px;">{{ $totalApplications }}</div>
        <div class="stat-card-label">Total Tracked</div>
    </div>
    <div class="stat-card" style="padding:16px 18px;">
        <div class="stat-card-value" style="font-size:22px;color:var(--accent);">{{ $appliedCount }}</div>
        <div class="stat-card-label">Applied</div>
    </div>
    <div class="stat-card" style="padding:16px 18px;">
        <div class="stat-card-value" style="font-size:22px;color:var(--success);">{{ $passedCount }}</div>
        <div class="stat-card-label">Passed</div>
    </div>
    <div class="stat-card" style="padding:16px 18px;">
        <div class="stat-card-value" style="font-size:22px;color:var(--danger);">{{ $failedCount }}</div>
        <div class="stat-card-label">Failed</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

    {{-- Tracked applications --}}
    <div class="a-card">
        <div class="a-card-head">
            <h2>Tracked Applications</h2>
            <span class="badge badge-slate">{{ $totalApplications }}</span>
        </div>
        @if ($applications->isEmpty())
            <div class="empty-state" style="padding:40px 24px;">
                <svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h5"/></svg>
                <h3>No applications yet</h3>
                <p>This student hasn't tracked any scholarships.</p>
            </div>
        @else
            <div class="a-table-wrap">
                <table class="a-table">
                    <thead>
                        <tr>
                            <th>Scholarship</th>
                            <th>Applied</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $app)
                            <tr>
                                <td>
                                    <div style="font-weight:600;font-size:13px;">{{ Str::limit($app->scholarship_title, 35) }}</div>
                                    @if ($app->provider)
                                        <div style="font-size:12px;color:var(--muted);">{{ $app->provider }}</div>
                                    @endif
                                </td>
                                <td style="font-size:13px;color:var(--muted);">{{ $app->applied_at->format('M d, Y') }}</td>
                                <td>
                                    @php
                                        $statusClass = match($app->status) {
                                            'passed' => 'badge-green',
                                            'failed' => 'badge-red',
                                            default  => 'badge-indigo',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst($app->status) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Recommended scholarships (matching) --}}
    <div class="a-card">
        <div class="a-card-head">
            <h2>Matching Scholarships</h2>
            <span class="badge badge-green">{{ $matchedScholarships->count() }} match{{ $matchedScholarships->count() === 1 ? '' : 'es' }}</span>
        </div>
        @if ($matchedScholarships->isEmpty())
            <div class="empty-state" style="padding:40px 24px;">
                <svg viewBox="0 0 24 24"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/></svg>
                <h3>No new matches</h3>
                <p>This student is already tracking all published scholarships for their level, or no scholarships are published yet.</p>
            </div>
        @else
            <div class="a-table-wrap">
                <table class="a-table">
                    <thead>
                        <tr>
                            <th>Scholarship</th>
                            <th>Type</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matchedScholarships->take(15) as $scholarship)
                            <tr>
                                <td>
                                    <div style="font-weight:600;font-size:13px;">{{ Str::limit($scholarship->title, 35) }}</div>
                                    <div style="font-size:12px;color:var(--muted);">{{ $scholarship->provider }}</div>
                                </td>
                                <td><span class="badge badge-slate" style="font-size:11px;">{{ $scholarship->type_label }}</span></td>
                                <td style="font-size:12px;color:var(--muted);">
                                    {{ $scholarship->deadline ? $scholarship->deadline->format('M d, Y') : '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    @media (max-width: 900px) {
        div[style*="grid-template-columns:1fr 1fr"] { grid-template-columns: 1fr !important; }
        div[style*="grid-template-columns:repeat(4"] { grid-template-columns: 1fr 1fr !important; }
    }
    @media (max-width: 500px) {
        div[style*="grid-template-columns:repeat(4"] { grid-template-columns: 1fr !important; }
    }
</style>
@endpush
@endsection
