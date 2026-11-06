@extends('pages.admin.app')

@section('title', 'Dashboard')
@section('topbar-title', 'Dashboard Overview')

@section('content')
<div class="a-page-head">
    <div>
        <h1>Welcome back, {{ auth()->user()->first_name }} 👋</h1>
        <p>Here's what's happening in ScholarHunt today.</p>
    </div>
    <a href="{{ route('admin.scholarships.create') }}" class="btn btn-primary">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>
        Add Scholarship
    </a>
</div>

{{-- Stat cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-card-icon ic-indigo">
            <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
        </div>
        <div class="stat-card-value">{{ number_format($stats['total_users']) }}</div>
        <div class="stat-card-label">Registered Students</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon ic-teal">
            <svg viewBox="0 0 24 24"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/></svg>
        </div>
        <div class="stat-card-value">{{ number_format($stats['total_scholarships']) }}</div>
        <div class="stat-card-label">Total Scholarships</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon ic-green">
            <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
        </div>
        <div class="stat-card-value">{{ number_format($stats['published_scholarships']) }}</div>
        <div class="stat-card-label">Published</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon ic-amber">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg>
        </div>
        <div class="stat-card-value">{{ number_format($stats['draft_scholarships']) }}</div>
        <div class="stat-card-label">Drafts</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon ic-slate">
            <svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h5M8 17h3"/></svg>
        </div>
        <div class="stat-card-value">{{ number_format($stats['total_applications']) }}</div>
        <div class="stat-card-label">Applications Tracked</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon ic-green">
            <svg viewBox="0 0 24 24"><path d="m9 11 3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <div class="stat-card-value">{{ number_format($stats['passed_applications']) }}</div>
        <div class="stat-card-label">Passed Applications</div>
    </div>
</div>

{{-- Two-column tables --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

    {{-- Recent students --}}
    <div class="a-card">
        <div class="a-card-head">
            <h2>Recent Students</h2>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">View all</a>
        </div>
        <div class="a-table-wrap">
            <table class="a-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentUsers as $user)
                        <tr>
                            <td>
                                <a href="{{ route('admin.users.show', $user) }}" style="font-weight:600;color:var(--accent);">
                                    {{ $user->full_name }}
                                </a>
                                <div style="font-size:12px;color:var(--muted);">{{ $user->email }}</div>
                            </td>
                            <td>
                                <span class="badge {{ $user->education_level === 'college' ? 'badge-teal' : 'badge-indigo' }}">
                                    {{ strtoupper($user->education_level) }}
                                </span>
                            </td>
                            <td style="color:var(--muted);font-size:13px;">{{ $user->created_at->format('M d') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="text-align:center;color:var(--muted);padding:24px;">No students yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent scholarships --}}
    <div class="a-card">
        <div class="a-card-head">
            <h2>Recent Scholarships</h2>
            <a href="{{ route('admin.scholarships.index') }}" class="btn btn-secondary btn-sm">View all</a>
        </div>
        <div class="a-table-wrap">
            <table class="a-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentScholarships as $scholarship)
                        <tr>
                            <td>
                                <a href="{{ route('admin.scholarships.edit', $scholarship) }}" style="font-weight:600;color:var(--accent);">
                                    {{ Str::limit($scholarship->title, 38) }}
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-slate">{{ $scholarship->type_label }}</span>
                            </td>
                            <td>
                                @if ($scholarship->is_published)
                                    <span class="badge badge-green">Published</span>
                                @else
                                    <span class="badge badge-draft">Draft</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="text-align:center;color:var(--muted);padding:24px;">No scholarships yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @media (max-width: 900px) {
        div[style*="grid-template-columns:1fr 1fr"] { grid-template-columns: 1fr !important; }
    }
</style>
@endsection
