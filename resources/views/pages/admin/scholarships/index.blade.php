@extends('pages.admin.app')

@section('title', 'Scholarships')
@section('topbar-title', 'Scholarships')

@section('content')
<div class="a-page-head">
    <div>
        <h1>Scholarships</h1>
        <p>Search the web for scholarships, then add them to the platform.</p>
    </div>
    <a href="{{ route('admin.scholarships.create') }}" class="btn btn-primary">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>
        Add Manually
    </a>
</div>

{{-- ── Google Search Panel ── --}}
<div class="a-card" style="margin-bottom:24px;">
    <div class="a-card-head">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="width:32px;height:32px;border-radius:8px;background:#EEF2FF;display:grid;place-items:center;flex:none;">
                <svg viewBox="0 0 24 24" style="width:16px;color:var(--accent);"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/></svg>
            </div>
            <div>
                <h2 style="font-size:15px;">Search Google for Scholarships</h2>
                <p style="font-size:12px;color:var(--muted);margin:0;">Opens Google in a new tab — find a scholarship, then come back and add it manually.</p>
            </div>
        </div>
    </div>
    <div class="a-card-body">
        <div style="display:flex;gap:10px;margin-bottom:16px;">
            <div class="input-group" style="flex:1;">
                <input
                    type="text"
                    id="google-search-input"
                    class="input"
                    placeholder='e.g. "DOST scholarship 2027 Philippines" or "SM Foundation scholarship requirements"'
                    aria-label="Search scholarships on Google"
                    onkeydown="if(event.key==='Enter'){openGoogleSearch()}"
                >
                <button type="button" class="btn btn-primary" onclick="openGoogleSearch()">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/></svg>
                    Search Google
                </button>
            </div>
            <a href="{{ route('admin.scholarships.create') }}" class="btn btn-success">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>
                Add What You Found
            </a>
        </div>

        {{-- Quick search buttons --}}
        <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
            <span style="font-size:12px;font-weight:600;color:var(--muted);margin-right:4px;">Quick search:</span>
            @php
                $quickSearches = [
                    'DOST SEI scholarship 2027 Philippines',
                    'CHED scholarship Philippines 2027',
                    'SM Foundation college scholarship',
                    'Gokongwei Brothers Foundation scholarship',
                    'Jollibee Group Foundation scholarship',
                    'MEXT Japan scholarship Philippines',
                    'KGSP Korea scholarship Philippines 2027',
                    'Aboitiz scholarship program',
                    'LGU scholarship Philippines',
                    'PMA cadetship application 2027',
                ];
            @endphp
            @foreach ($quickSearches as $qs)
                <button
                    type="button"
                    onclick="openGoogleSearchFor({{ json_encode($qs) }})"
                    style="padding:5px 11px;border-radius:99px;border:1px solid var(--line);background:var(--paper);font-size:12px;font-weight:500;color:var(--body);cursor:pointer;transition:background .15s,border-color .15s;"
                    onmouseover="this.style.background='#EEF2FF';this.style.borderColor='var(--accent)';this.style.color='var(--accent)'"
                    onmouseout="this.style.background='var(--paper)';this.style.borderColor='var(--line)';this.style.color='var(--body)'"
                >
                    {{ $qs }}
                </button>
            @endforeach
        </div>

        <div style="margin-top:14px;padding:12px 14px;background:#F8FAFC;border:1px solid var(--line);border-radius:var(--radius-sm);font-size:13px;color:var(--muted);display:flex;gap:10px;align-items:flex-start;">
            <svg viewBox="0 0 24 24" style="width:15px;flex:none;margin-top:1px;color:var(--accent);"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg>
            <span><strong style="color:var(--body);">How it works:</strong> Search Google → find a real scholarship page → copy the details → come back and click <strong style="color:var(--body);">"Add What You Found"</strong> to fill in the form and publish it to students.</span>
        </div>
    </div>
</div>

{{-- Filter bar --}}
<form method="GET" action="{{ route('admin.scholarships.index') }}" class="filter-bar">
    <div style="font-size:13px;font-weight:700;color:var(--body);white-space:nowrap;margin-right:4px;">In database:</div>
    <div class="input-group" style="flex:1;max-width:320px;">
        <input
            type="search"
            name="q"
            class="input"
            placeholder="Filter existing scholarships…"
            value="{{ $filters['q'] ?? '' }}"
            aria-label="Filter scholarships"
        >
        <button type="submit" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/></svg>
        </button>
    </div>
    <select name="type" class="select" onchange="this.form.submit()" aria-label="Filter by type">
        <option value="">All Types</option>
        @foreach ($types as $key => $label)
            <option value="{{ $key }}" @selected(($filters['type'] ?? '') === $key)>{{ $label }}</option>
        @endforeach
    </select>
    <select name="status" class="select" onchange="this.form.submit()" aria-label="Filter by status">
        <option value="">All Status</option>
        <option value="published" @selected(($filters['status'] ?? '') === 'published')>Published</option>
        <option value="draft"     @selected(($filters['status'] ?? '') === 'draft')>Draft</option>
    </select>
    @if (array_filter($filters))
        <a href="{{ route('admin.scholarships.index') }}" class="btn btn-secondary btn-sm">Clear</a>
    @endif
</form>

{{-- Table --}}
<div class="a-card">
    <div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Scholarship</th>
                    <th>Type</th>
                    <th>Levels</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($scholarships as $scholarship)
                    <tr>
                        <td style="max-width:280px;">
                            <div style="font-weight:600;">{{ $scholarship->title }}</div>
                            <div style="font-size:12px;color:var(--muted);">{{ $scholarship->provider }}</div>
                        </td>
                        <td>
                            <span class="badge badge-slate">{{ $scholarship->type_label }}</span>
                        </td>
                        <td>
                            @foreach ($scholarship->levels as $level)
                                <span class="badge {{ $level === 'college' ? 'badge-teal' : 'badge-indigo' }}" style="margin-right:3px;">
                                    {{ strtoupper($level) }}
                                </span>
                            @endforeach
                        </td>
                        <td style="font-size:13px;color:var(--muted);">
                            {{ $scholarship->deadline ? $scholarship->deadline->format('M d, Y') : '—' }}
                        </td>
                        <td>
                            @if ($scholarship->is_published)
                                <span class="badge badge-green">
                                    <svg viewBox="0 0 24 24" style="width:10px;height:10px;fill:currentColor;stroke:none;"><circle cx="12" cy="12" r="6"/></svg>
                                    Published
                                </span>
                            @else
                                <span class="badge badge-draft">Draft</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;align-items:center;">
                                <a href="{{ route('admin.scholarships.edit', $scholarship) }}"
                                   class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                    <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
                                </a>

                                {{-- Toggle publish --}}
                                <form method="POST" action="{{ route('admin.scholarships.toggle-publish', $scholarship) }}" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm btn-icon {{ $scholarship->is_published ? 'btn-secondary' : 'btn-success' }}"
                                        title="{{ $scholarship->is_published ? 'Set to draft' : 'Publish' }}">
                                        @if ($scholarship->is_published)
                                            <svg viewBox="0 0 24 24"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><path d="m1 1 22 22"/></svg>
                                        @else
                                            <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        @endif
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form method="POST" action="{{ route('admin.scholarships.destroy', $scholarship) }}"
                                    data-confirm="Delete '{{ addslashes($scholarship->title) }}'? This cannot be undone.">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete">
                                        <svg viewBox="0 0 24 24"><path d="M3 6h18M19 6l-1 14H6L5 6M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <svg viewBox="0 0 24 24"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/></svg>
                                <h3>No scholarships found</h3>
                                <p>Try adjusting your search or <a href="{{ route('admin.scholarships.create') }}" style="color:var(--accent);">add one manually</a>.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($scholarships->hasPages())
        <div class="pagination">
            {{ $scholarships->links('vendor.pagination.admin') }}
        </div>
    @endif
</div>

@push('scripts')
<script>
function openGoogleSearch() {
    const query = document.getElementById('google-search-input').value.trim();
    if (!query) return;
    const url = 'https://www.google.com/search?q=' + encodeURIComponent(query + ' scholarship Philippines');
    window.open(url, '_blank', 'noopener');
}

function openGoogleSearchFor(query) {
    const url = 'https://www.google.com/search?q=' + encodeURIComponent(query);
    window.open(url, '_blank', 'noopener');
}
</script>
@endpush
@endsection
