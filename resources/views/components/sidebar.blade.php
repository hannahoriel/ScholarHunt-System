@php
    $displayName = trim((auth()->user()->first_name ?? '').' '.(auth()->user()->surname ?? ''));
    $initials = collect(explode(' ', $displayName))
        ->filter()
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->take(2)
        ->implode('');
    $links = [
        'dashboard' => ['Dashboard', '<path d="M3 11.5 12 4l9 7.5"/><path d="M5 10v10h14V10"/><path d="M10 20v-5h4v5"/>'],
        'tracker' => ['Tracker', '<rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h5M8 17h3"/>'],
        'checklist' => ['Checklist', '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="m8 10 2 2 4-4M8 17h8"/>'],
        'reviewers' => ['Reviewers', '<path d="M3 5.5C5.5 4 9 4 12 6c3-2 6.5-2 9-.5V19c-2.5-1.5-6-1.5-9 .5-3-2-6.5-2-9-.5V5.5Z"/><path d="M12 6v13.5"/>'],
        'profile' => ['Profile settings', '<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-6.5 8-6.5s8 2.5 8 6.5"/>'],
    ];
@endphp

<aside class="sidebar" id="sidebar" aria-label="Main navigation">
    <div class="sidebar-brand-row">
        <a class="wordmark" href="{{ route('dashboard') }}" aria-label="ScholarHunt dashboard">
            <span class="brand-mark"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/></svg></span><span class="wordmark-label">ScholarHunt</span>
        </a>
        <button class="sidebar-collapse-btn" id="sidebar-collapse-toggle" type="button" aria-label="Collapse navigation" aria-expanded="true" aria-controls="sidebar" title="Collapse navigation">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m14 5-7 7 7 7M20 5l-7 7 7 7"/></svg>
        </button>
    </div>
    <nav class="nav">
        @foreach ($links as $route => [$label, $icon])
            <a href="{{ match($route) { 'dashboard' => route('dashboard'), 'reviewers' => route('dashboard.reviewer'), 'tracker' => route('dashboard.tracker'), 'checklist' => route('dashboard.checklist'), 'profile' => route('dashboard.profile'), default => '#' } }}"
                aria-label="{{ $label }}" title="{{ $label }}"
                @if (($route === 'dashboard' && request()->routeIs('dashboard')) || ($route === 'reviewers' && request()->routeIs('dashboard.reviewer')) || ($route === 'tracker' && request()->routeIs('dashboard.tracker*')) || ($route === 'checklist' && request()->routeIs('dashboard.checklist')) || ($route === 'profile' && request()->routeIs('dashboard.profile*'))) aria-current="page" @endif>
                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $icon !!}</svg><span class="nav-label">{{ $label }}</span>
            </a>
        @endforeach
    </nav>
    <div class="sidebar-footer">
        <details class="side-account" id="side-account">
            <summary class="side-user" title="{{ $displayName }}" aria-label="Account menu for {{ $displayName ?: 'student' }}">
                <span class="avatar">{{ $initials ?: 'SH' }}</span>
                <div class="side-user-copy"><strong>{{ $displayName }}</strong><small>Student</small></div>
                <svg class="account-chevron" viewBox="0 0 24 24" aria-hidden="true"><path d="m7 10 5 5 5-5"/></svg>
            </summary>
            <div class="side-account-menu">
                <a class="side-account-profile" href="{{ route('dashboard.profile') }}">
                    <strong>{{ $displayName }}</strong>
                    <small>{{ auth()->user()->email }}</small>
                </a>
                <form class="sidebar-logout" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" aria-label="Log out" title="Log out">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"/></svg>
                        <span class="logout-label">Log out</span>
                    </button>
                </form>
            </div>
        </details>
    </div>
</aside>
