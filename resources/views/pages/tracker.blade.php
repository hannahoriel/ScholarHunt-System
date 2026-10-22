@extends('pages.dashboard.app')
@section('title', 'Application Tracker')
@push('styles')
<style>
.tracker-page{display:grid;gap:24px}.page-head{display:flex;align-items:flex-end;justify-content:space-between;gap:18px;flex-wrap:wrap}.kicker{font-size:10px;letter-spacing:.16em;font-weight:800;color:var(--teal)}.page-head h1{font-size:clamp(27px,3vw,36px);letter-spacing:-.055em;line-height:1.15;margin-top:5px}.page-head p{color:var(--muted);font-size:13px;margin-top:8px}.tracker-link{display:inline-flex;align-items:center;justify-content:center;gap:8px;border-radius:9px;background:var(--teal);color:white;padding:12px 16px;font-weight:800;font-size:12px}.tracker-stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px}.stat{background:white;border:1px solid var(--line);border-radius:15px;padding:20px;box-shadow:var(--shadow-sm)}.stat small{display:block;color:var(--muted);font-size:11px;font-weight:700}.stat strong{display:block;font:800 29px/1.3 'Manrope',sans-serif;letter-spacing:-.05em;margin-top:8px}.stat span{font-size:11px;color:var(--muted)}.tracker-toolbar{display:flex;gap:12px;align-items:center;justify-content:space-between;flex-wrap:wrap}.tracker-toolbar h2{font-size:20px;letter-spacing:-.04em}.tracker-filters{display:flex;gap:7px;flex-wrap:wrap}.tracker-filters a{padding:8px 12px;border:1px solid var(--line);border-radius:99px;background:#fff;color:var(--muted);font-size:11px;font-weight:800}.tracker-filters a.active{background:#E5F1F7;border-color:#B7D3E2;color:var(--teal)}.application-list{display:grid;gap:14px}.application-card{background:#fff;border:1px solid var(--line);border-radius:16px;overflow:hidden;box-shadow:var(--shadow-sm)}.application-top{display:flex;align-items:flex-start;justify-content:space-between;gap:15px;padding:21px 22px 16px;border-bottom:1px solid #EAF0F4}.app-title{display:flex;gap:13px;min-width:0}.app-symbol{width:44px;height:44px;display:grid;place-items:center;flex:none;border-radius:12px;background:#E5F1F7;color:var(--teal)}.app-title h3{font-size:16px;line-height:1.4;letter-spacing:-.025em}.app-title p{font-size:12px;color:var(--muted);margin-top:4px}.status-pill{display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:99px;font-size:10px;font-weight:800;white-space:nowrap}.status-applied{background:#E8F1FB;color:#285E96}.status-passed{background:#E4F6EC;color:#177347}.status-failed{background:#FCEBE9;color:#AD3B32}.app-details{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;padding:17px 22px}.detail-item small{display:block;font-size:10px;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);font-weight:800}.detail-item strong{display:block;font-size:12px;margin-top:4px;overflow-wrap:anywhere}.app-edit{padding:18px 22px 21px;background:#F8FBFD;border-top:1px solid #EAF0F4}.app-edit summary{font-size:12px;color:var(--teal);font-weight:800;cursor:pointer}.edit-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:13px;margin-top:16px}.field{display:grid;gap:6px}.field label{font-size:11px;font-weight:800;color:#3D556A}.field input,.field select,.field textarea{width:100%;border:1px solid #CBD9E2;background:#fff;border-radius:8px;padding:10px 11px;font-size:12px;color:var(--navy)}.field textarea{min-height:82px;resize:vertical}.field.full{grid-column:1/-1}.form-actions{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-top:14px}.btn-main,.btn-danger{border:0;border-radius:8px;padding:10px 14px;font-size:11px;font-weight:800}.btn-main{background:var(--teal);color:white}.btn-danger{background:#FCEBE9;color:#AD3B32}.empty-state{padding:52px 20px;text-align:center;border:1px dashed #B9CDD9;border-radius:16px;background:#fff}.empty-state h3{font-size:18px}.empty-state p{color:var(--muted);font-size:13px;margin:8px auto 18px;max-width:450px}.flash-message{padding:12px 15px;border-radius:9px;background:#E4F6EC;color:#177347;font-size:12px;font-weight:700}.validation-errors{padding:12px 15px;background:#FCEBE9;color:#AD3B32;border-radius:9px;font-size:12px}.validation-errors ul{padding-left:18px}@media(max-width:850px){.tracker-stats{grid-template-columns:repeat(2,minmax(0,1fr))}}@media(max-width:560px){.app-details{grid-template-columns:1fr 1fr;padding:16px}.application-top{padding:17px;flex-direction:column}.app-edit{padding:16px}.edit-grid{grid-template-columns:1fr}.field.full{grid-column:auto}.stat{padding:15px}.stat strong{font-size:25px}}
</style>
@endpush
@section('content')
@php
    $statusFilter = request('status', 'all');
    $visibleApplications = $statusFilter === 'all' ? $applications : $applications->where('status', $statusFilter);
    $total = $applications->count();
    $appliedCount = $applications->where('status', 'applied')->count();
    $passedCount = $applications->where('status', 'passed')->count();
    $failedCount = $applications->where('status', 'failed')->count();
@endphp
<div class="tracker-page">
    <header class="page-head">
        <div><span class="kicker">YOUR SCHOLARSHIP JOURNEY</span><h1>Application tracker</h1><p>Keep every application, important date, follow-up, and result organized in one place.</p></div>
        <a class="tracker-link" href="{{ route('dashboard.discover') }}">＋ Discover scholarships</a>
    </header>
    @if(session('status'))<div class="flash-message" role="status">{{ session('status') }}</div>@endif
    @if($errors->any())<div class="validation-errors"><strong>Please check the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <section class="tracker-stats" aria-label="Application summary">
        <div class="stat"><small>Total tracked</small><strong>{{ $total }}</strong><span>Scholarships in your list</span></div>
        <div class="stat"><small>In progress</small><strong>{{ $appliedCount }}</strong><span>Waiting for a result</span></div>
        <div class="stat"><small>Passed</small><strong>{{ $passedCount }}</strong><span>Marked successful by you</span></div>
        <div class="stat"><small>Failed</small><strong>{{ $failedCount }}</strong><span>Marked unsuccessful by you</span></div>
    </section>
    <section>
        <div class="tracker-toolbar"><h2>Your applications</h2><nav class="tracker-filters" aria-label="Filter applications">
            @foreach(['all'=>'All','applied'=>'In progress','passed'=>'Passed','failed'=>'Failed'] as $key=>$label)
            <a class="{{ $statusFilter === $key ? 'active' : '' }}" href="{{ route('dashboard.tracker', $key === 'all' ? [] : ['status'=>$key]) }}">{{ $label }}</a>
            @endforeach
        </nav></div>
        <div class="application-list" style="margin-top:15px">
        @forelse($visibleApplications as $application)
            <article class="application-card">
                <div class="application-top">
                    <div class="app-title"><span class="app-symbol"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5M21 9v6"/></svg></span><div><h3>{{ $application->scholarship_title }}</h3><p>{{ $application->provider ?: 'Provider not specified' }}@if($application->scholarship_type) · {{ \Illuminate\Support\Str::headline($application->scholarship_type) }}@endif</p></div></div>
                    <span class="status-pill status-{{ $application->status }}">{{ ['applied'=>'In progress','passed'=>'Passed','failed'=>'Failed'][$application->status] }}</span>
                </div>
                <div class="app-details">
                    <div class="detail-item"><small>Date applied</small><strong>{{ $application->applied_at?->format('M d, Y') ?? 'Not set' }}</strong></div>
                    <div class="detail-item"><small>Last updated</small><strong>{{ $application->updated_at->format('M d, Y') }}</strong></div>
                    <div class="detail-item"><small>Application reference</small><strong>{{ $application->application_reference ?: 'Not added yet' }}</strong></div>
                </div>
                @if($application->notes)<div style="padding:0 22px 17px;font-size:12px;color:var(--muted)"><strong style="color:var(--navy)">Notes:</strong> {{ $application->notes }}</div>@endif
                <details class="app-edit"><summary>Edit application details or update your result</summary>
                    <form method="POST" action="{{ route('dashboard.tracker.update', $application) }}">
                        @csrf @method('PATCH')
                        <div class="edit-grid">
                            <div class="field"><label for="applied-{{ $application->id }}">Date of application</label><input id="applied-{{ $application->id }}" type="date" name="applied_at" max="{{ now()->toDateString() }}" value="{{ old('applied_at', $application->applied_at?->format('Y-m-d')) }}" required></div>
                            <div class="field"><label for="status-{{ $application->id }}">Application result (manual)</label><select id="status-{{ $application->id }}" name="status" required><option value="applied" @selected($application->status==='applied')>Applied / Waiting for result</option><option value="passed" @selected($application->status==='passed')>Passed</option><option value="failed" @selected($application->status==='failed')>Failed</option></select></div>
                            <div class="field full"><label for="ref-{{ $application->id }}">Application reference / confirmation number</label><input id="ref-{{ $application->id }}" name="application_reference" maxlength="150" value="{{ old('application_reference', $application->application_reference) }}" placeholder="e.g. confirmation ID (optional)"></div>
                            <div class="field full"><label for="notes-{{ $application->id }}">Notes and follow-up details</label><textarea id="notes-{{ $application->id }}" name="notes" maxlength="5000" placeholder="Interview schedule, missing documents, contact person, next steps…">{{ old('notes', $application->notes) }}</textarea></div>
                        </div>
                        <div class="form-actions"><button class="btn-main" type="submit">Save changes</button></div>
                    </form>
                    <form method="POST" action="{{ route('dashboard.tracker.destroy', $application) }}" onsubmit="return confirm('Remove this scholarship from your tracker? This cannot be undone.')">@csrf @method('DELETE')<div class="form-actions"><span style="font-size:11px;color:var(--muted)">Remove this record if you no longer need it.</span><button class="btn-danger" type="submit">Remove from tracker</button></div></form>
                </details>
            </article>
        @empty
            <div class="empty-state"><h3>{{ $statusFilter === 'all' ? 'Your tracker is ready when you are' : 'No applications in this category' }}</h3><p>{{ $statusFilter === 'all' ? 'Open Discover Scholarships, choose a scholarship you have applied for, and select “Save to tracker”. Your application date and status will be stored here.' : 'Try another filter or add scholarships from the discovery page.' }}</p><a class="tracker-link" href="{{ route('dashboard.discover') }}">Browse scholarships</a></div>
        @endforelse
        </div>
    </section>
</div>
@endsection
