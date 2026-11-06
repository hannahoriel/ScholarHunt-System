@extends('pages.admin.app')

@section('title', 'Students')
@section('topbar-title', 'Student Management')

@section('content')
<div class="a-page-head">
    <div>
        <h1>Students</h1>
        <p>Manage registered student accounts and view their scholarship activity.</p>
    </div>
    <div style="display:flex;gap:10px;">
        <span class="badge badge-indigo" style="font-size:13px;padding:7px 14px;">
            {{ $users->total() }} {{ Str::plural('student', $users->total()) }}
        </span>
    </div>
</div>

{{-- Filter bar --}}
<form method="GET" action="{{ route('admin.users.index') }}" class="filter-bar">
    <div class="input-group" style="flex:1;max-width:360px;">
        <input
            type="search"
            name="q"
            class="input"
            placeholder="Search name, email, school…"
            value="{{ $filters['q'] ?? '' }}"
            aria-label="Search students"
        >
        <button type="submit" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/></svg>
        </button>
    </div>
    <select name="level" class="select" onchange="this.form.submit()" aria-label="Filter by level">
        <option value="">All Levels</option>
        <option value="shs"     @selected(($filters['level'] ?? '') === 'shs')>Senior High School</option>
        <option value="college" @selected(($filters['level'] ?? '') === 'college')>College</option>
    </select>
    @if (array_filter($filters))
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Clear</a>
    @endif
</form>

<div class="a-card">
    <div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Level / Year</th>
                    <th>School</th>
                    <th>City</th>
                    <th>Applications</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:50%;background:#EEF2FF;color:var(--accent);display:grid;place-items:center;font:700 12px 'Manrope',sans-serif;flex:none;">
                                    {{ mb_substr($user->first_name, 0, 1) }}{{ mb_substr($user->surname, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;">{{ $user->full_name }}</div>
                                    <div style="font-size:12px;color:var(--muted);">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $user->education_level === 'college' ? 'badge-teal' : 'badge-indigo' }}">
                                {{ strtoupper($user->education_level) }}
                            </span>
                            @if ($user->education_level === 'college' && $user->college_year)
                                <div style="font-size:12px;color:var(--muted);margin-top:3px;">Year {{ $user->college_year }}</div>
                            @elseif ($user->education_level === 'shs' && $user->shs_grade)
                                <div style="font-size:12px;color:var(--muted);margin-top:3px;">Grade {{ $user->shs_grade }}</div>
                            @endif
                        </td>
                        <td style="font-size:13px;max-width:200px;">
                            <div style="font-weight:500;">{{ Str::limit($user->school_name, 30) }}</div>
                        </td>
                        <td style="font-size:13px;color:var(--muted);">{{ $user->address_city }}</td>
                        <td>
                            @if ($user->scholarship_applications_count > 0)
                                <span class="badge badge-green">{{ $user->scholarship_applications_count }}</span>
                            @else
                                <span style="font-size:13px;color:var(--muted);">—</span>
                            @endif
                        </td>
                        <td style="font-size:13px;color:var(--muted);">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('admin.users.show', $user) }}"
                                   class="btn btn-secondary btn-sm" title="View profile">
                                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/></svg>
                                    View
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    data-confirm="Delete {{ addslashes($user->full_name) }}'s account? This will also remove all their tracked applications.">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete user">
                                        <svg viewBox="0 0 24 24"><path d="M3 6h18M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
                                <h3>No students found</h3>
                                <p>Try adjusting your search filters.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($users->hasPages())
        <div class="pagination">
            {{ $users->links('vendor.pagination.admin') }}
        </div>
    @endif
</div>
@endsection
