<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0F172A">
    <title>@yield('title', 'Admin') — ScholarHunt Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ── Design tokens ── */
        :root {
            --navy: #0F172A; --navy-mid: #1E293B; --navy-soft: #334155;
            --accent: #6366F1; --accent-dk: #4F46E5; --accent-lt: #818CF8;
            --teal: #0EA5E9; --teal-dk: #0284C7;
            --success: #10B981; --warn: #F59E0B; --danger: #EF4444;
            --success-bg: #D1FAE5; --warn-bg: #FEF3C7; --danger-bg: #FEE2E2;
            --success-txt: #065F46; --warn-txt: #92400E; --danger-txt: #991B1B;
            --paper: #F8FAFC; --card: #FFFFFF; --line: #E2E8F0;
            --muted: #64748B; --body: #1E293B;
            --shadow-sm: 0 1px 3px #0F172A0F, 0 1px 2px #0F172A08;
            --shadow-md: 0 4px 16px #0F172A14, 0 1px 4px #0F172A0A;
            --radius: 10px; --radius-sm: 6px; --radius-lg: 14px;
            --side: 248px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            line-height: 1.6;
            background: var(--paper);
            color: var(--body);
            -webkit-font-smoothing: antialiased;
        }
        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }
        button { cursor: pointer; }
        h1, h2, h3, h4, .wordmark { font-family: 'Manrope', sans-serif; }
        :focus-visible { outline: 2px solid var(--accent); outline-offset: 3px; border-radius: 3px; }
        svg { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 1.7; stroke-linecap: round; stroke-linejoin: round; flex: none; }

        /* ── Shell layout ── */
        .a-shell { display: grid; grid-template-columns: var(--side) 1fr; min-height: 100svh; }
        .a-sidebar {
            position: sticky; top: 0; height: 100svh;
            background: var(--navy); color: #94A3B8;
            display: flex; flex-direction: column; gap: 6px;
            padding: 24px 14px 20px;
            overflow-y: auto; overflow-x: hidden;
        }
        .a-main { min-width: 0; display: flex; flex-direction: column; }

        /* ── Sidebar brand ── */
        .a-brand {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 10px 18px;
            font-family: 'Manrope', sans-serif; font-weight: 800;
            font-size: 18px; letter-spacing: -.05em; color: #F1F5F9;
        }
        .a-brand-mark {
            width: 34px; height: 34px; border-radius: 9px;
            background: var(--accent); display: grid; place-items: center;
            box-shadow: 0 0 0 3px #6366F140;
            flex: none;
        }
        .a-brand-mark svg { width: 17px; stroke: #fff; stroke-width: 2; }
        .a-brand-sub {
            font-size: 10px; font-weight: 600; letter-spacing: .08em;
            text-transform: uppercase; color: var(--accent-lt); opacity: .85;
            display: block; line-height: 1;
        }

        /* ── Sidebar nav ── */
        .a-nav-label {
            font-size: 10.5px; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: #475569;
            padding: 14px 12px 5px; display: block;
        }
        .a-nav-item {
            display: flex; align-items: center; gap: 11px;
            padding: 10px 12px; border-radius: var(--radius-sm);
            font-size: 14px; font-weight: 500; color: #94A3B8;
            transition: background .18s, color .18s;
        }
        .a-nav-item:hover { background: #ffffff0D; color: #F1F5F9; }
        .a-nav-item.active { background: var(--accent); color: #fff; font-weight: 700; }
        .a-nav-item svg { width: 17px; height: 17px; opacity: .85; }
        .a-nav-item.active svg { opacity: 1; }

        /* ── Sidebar divider ── */
        .a-sidebar-divider { border: none; border-top: 1px solid #1E293B; margin: 10px 0; }

        /* ── Sidebar user card ── */
        .a-sidebar-user {
            margin-top: auto; padding-top: 14px;
            border-top: 1px solid #1E293B;
        }
        .a-user-card {
            display: flex; align-items: center; gap: 11px;
            padding: 10px; border-radius: var(--radius);
            background: #ffffff08;
        }
        .a-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--accent); color: #fff;
            display: grid; place-items: center;
            font: 700 12px 'Manrope', sans-serif; flex: none;
        }
        .a-user-name { font-size: 13px; font-weight: 600; color: #F1F5F9; display: block; line-height: 1.3; }
        .a-user-role { font-size: 11px; color: var(--accent-lt); }
        .a-logout-btn {
            display: flex; align-items: center; gap: 10px; width: 100%;
            padding: 9px 12px; margin-top: 4px;
            border: none; border-radius: var(--radius-sm);
            background: transparent; color: #64748B;
            font-size: 13px; font-weight: 500;
            transition: background .18s, color .18s;
            text-align: left;
        }
        .a-logout-btn:hover { background: #EF444415; color: #EF4444; }
        .a-logout-btn svg { width: 15px; }

        /* ── Top bar ── */
        .a-topbar {
            background: var(--card); border-bottom: 1px solid var(--line);
            padding: 0 clamp(20px, 3vw, 40px);
            height: 60px; display: flex; align-items: center;
            gap: 16px; position: sticky; top: 0; z-index: 20;
        }
        .a-topbar-title {
            font-family: 'Manrope', sans-serif; font-weight: 700;
            font-size: 16px; color: var(--body); flex: 1;
        }
        .a-topbar-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: 99px;
            background: #6366F115; color: var(--accent);
            font-size: 12px; font-weight: 600;
        }
        .a-topbar-badge svg { width: 13px; }

        /* ── Content area ── */
        .a-content { padding: 36px clamp(20px, 3.5vw, 48px) 64px; flex: 1; }

        /* ── Flash messages ── */
        .flash {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 14px 16px; border-radius: var(--radius);
            margin-bottom: 24px; font-size: 14px; font-weight: 500;
        }
        .flash svg { width: 17px; flex: none; margin-top: 1px; }
        .flash.flash-success { background: var(--success-bg); color: var(--success-txt); }
        .flash.flash-error   { background: var(--danger-bg);  color: var(--danger-txt); }
        .flash.flash-warn    { background: var(--warn-bg);    color: var(--warn-txt); }

        /* ── Page header ── */
        .a-page-head {
            display: flex; align-items: flex-start; justify-content: space-between;
            flex-wrap: wrap; gap: 16px; margin-bottom: 28px;
        }
        .a-page-head h1 {
            font-size: clamp(22px, 2.5vw, 30px); font-weight: 800;
            letter-spacing: -.06em; line-height: 1.15; color: var(--body);
        }
        .a-page-head p { color: var(--muted); font-size: 14px; margin-top: 4px; }

        /* ── Stat cards ── */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; margin-bottom: 32px; }
        .stat-card {
            background: var(--card); border: 1px solid var(--line);
            border-radius: var(--radius-lg); padding: 20px 22px;
            box-shadow: var(--shadow-sm);
        }
        .stat-card-icon {
            width: 40px; height: 40px; border-radius: var(--radius);
            display: grid; place-items: center; margin-bottom: 14px;
        }
        .stat-card-icon svg { width: 20px; }
        .stat-card-value { font-family: 'Manrope', sans-serif; font-size: 28px; font-weight: 800; line-height: 1; color: var(--body); }
        .stat-card-label { font-size: 13px; color: var(--muted); margin-top: 4px; }
        .ic-indigo { background: #EEF2FF; color: var(--accent); }
        .ic-teal   { background: #E0F2FE; color: var(--teal); }
        .ic-green  { background: var(--success-bg); color: var(--success); }
        .ic-amber  { background: var(--warn-bg); color: var(--warn); }
        .ic-red    { background: var(--danger-bg); color: var(--danger); }
        .ic-slate  { background: #F1F5F9; color: #64748B; }

        /* ── Generic card ── */
        .a-card {
            background: var(--card); border: 1px solid var(--line);
            border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);
        }
        .a-card-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 22px; border-bottom: 1px solid var(--line);
            gap: 12px;
        }
        .a-card-head h2 { font-size: 15px; font-weight: 700; }
        .a-card-body { padding: 22px; }

        /* ── Table ── */
        .a-table-wrap { overflow-x: auto; }
        .a-table { width: 100%; border-collapse: collapse; font-size: 14px; }
        .a-table th {
            text-align: left; font-size: 11.5px; font-weight: 700;
            letter-spacing: .05em; text-transform: uppercase;
            color: var(--muted); padding: 11px 16px;
            border-bottom: 2px solid var(--line);
            white-space: nowrap;
        }
        .a-table td {
            padding: 13px 16px; border-bottom: 1px solid var(--line);
            vertical-align: middle;
        }
        .a-table tbody tr:last-child td { border-bottom: none; }
        .a-table tbody tr:hover td { background: #F8FAFC; }

        /* ── Badges ── */
        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 9px; border-radius: 99px;
            font-size: 12px; font-weight: 600; white-space: nowrap;
        }
        .badge-green   { background: var(--success-bg); color: var(--success-txt); }
        .badge-red     { background: var(--danger-bg);  color: var(--danger-txt); }
        .badge-amber   { background: var(--warn-bg);    color: var(--warn-txt); }
        .badge-indigo  { background: #EEF2FF;            color: var(--accent-dk); }
        .badge-teal    { background: #E0F2FE;            color: var(--teal-dk); }
        .badge-slate   { background: #F1F5F9;            color: #475569; }
        .badge-draft   { background: #F8FAFC; color: #94A3B8; border: 1px solid var(--line); }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px; border-radius: var(--radius-sm);
            font-size: 14px; font-weight: 600; border: 1.5px solid transparent;
            transition: background .18s, box-shadow .18s, border-color .18s, color .18s;
            cursor: pointer; white-space: nowrap;
        }
        .btn svg { width: 15px; }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-dk); box-shadow: 0 0 0 3px #6366F133; }
        .btn-secondary { background: var(--card); color: var(--body); border-color: var(--line); }
        .btn-secondary:hover { background: var(--paper); }
        .btn-danger { background: var(--card); color: var(--danger); border-color: #FECACA; }
        .btn-danger:hover { background: var(--danger-bg); }
        .btn-success { background: var(--success); color: #fff; }
        .btn-success:hover { background: #059669; }
        .btn-sm { padding: 6px 12px; font-size: 13px; }
        .btn-icon { padding: 7px; border-radius: var(--radius-sm); }

        /* ── Form elements ── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
        .form-full { grid-column: 1 / -1; }
        .field { display: flex; flex-direction: column; gap: 6px; }
        .field label { font-size: 13px; font-weight: 600; color: var(--body); }
        .field label .req { color: var(--danger); margin-left: 2px; }
        .field-hint { font-size: 12px; color: var(--muted); }
        .input, .select, .textarea {
            width: 100%; padding: 9px 13px;
            border: 1.5px solid var(--line); border-radius: var(--radius-sm);
            background: var(--card); color: var(--body);
            font-size: 14px; transition: border-color .18s, box-shadow .18s;
        }
        .input:focus, .select:focus, .textarea:focus {
            border-color: var(--accent); outline: none;
            box-shadow: 0 0 0 3px #6366F120;
        }
        .textarea { resize: vertical; min-height: 100px; }
        .input-group { display: flex; }
        .input-group .input { border-radius: var(--radius-sm) 0 0 var(--radius-sm); }
        .input-group .btn { border-radius: 0 var(--radius-sm) var(--radius-sm) 0; border-left: none; }
        .checkbox-row { display: flex; align-items: center; gap: 9px; }
        .checkbox-row input[type="checkbox"] { width: 17px; height: 17px; accent-color: var(--accent); cursor: pointer; }
        .field-error { font-size: 12px; color: var(--danger); }

        /* ── Search / filter bar ── */
        .filter-bar {
            display: flex; align-items: center; flex-wrap: wrap;
            gap: 10px; margin-bottom: 20px;
        }
        .filter-bar .input { max-width: 300px; }
        .filter-bar .select { max-width: 180px; }

        /* ── Pagination ── */
        .pagination { display: flex; align-items: center; gap: 6px; padding: 20px 22px; flex-wrap: wrap; }
        .pagination a, .pagination span {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 34px; height: 34px; padding: 0 10px;
            border-radius: var(--radius-sm); border: 1px solid var(--line);
            font-size: 13px; font-weight: 500; color: var(--muted);
            background: var(--card); transition: background .15s, color .15s;
        }
        .pagination a:hover { background: var(--paper); color: var(--body); }
        .pagination span[aria-current] { background: var(--accent); color: #fff; border-color: var(--accent); font-weight: 700; }
        .pagination span.disabled { opacity: .4; pointer-events: none; }

        /* ── Empty state ── */
        .empty-state {
            text-align: center; padding: 60px 24px;
            color: var(--muted);
        }
        .empty-state svg { width: 48px; height: 48px; margin: 0 auto 16px; opacity: .35; stroke-width: 1.2; }
        .empty-state h3 { font-size: 16px; font-weight: 700; color: var(--body); margin-bottom: 6px; }
        .empty-state p { font-size: 14px; }

        /* ── Confirm dialog ── */
        .confirm-dialog {
            display: none; position: fixed; inset: 0; z-index: 100;
            background: #0F172A99; align-items: center; justify-content: center;
        }
        .confirm-dialog.open { display: flex; }
        .confirm-box {
            background: var(--card); border-radius: var(--radius-lg);
            padding: 28px 32px; max-width: 420px; width: 90%;
            box-shadow: var(--shadow-md);
        }
        .confirm-box h3 { font-size: 17px; font-weight: 700; margin-bottom: 8px; }
        .confirm-box p { font-size: 14px; color: var(--muted); margin-bottom: 24px; }
        .confirm-actions { display: flex; gap: 10px; justify-content: flex-end; }

        /* ── Detail sections ── */
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .detail-item { display: flex; flex-direction: column; gap: 3px; }
        .detail-item dt { font-size: 12px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--muted); }
        .detail-item dd { font-size: 14px; color: var(--body); }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .a-shell { grid-template-columns: 1fr; }
            .a-sidebar { display: none; }
            .form-grid, .form-grid-3 { grid-template-columns: 1fr; }
            .detail-grid { grid-template-columns: 1fr; }
            .stat-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 500px) {
            .stat-grid { grid-template-columns: 1fr; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }

        @stack('styles')
    </style>
    @stack('styles')
</head>
<body>
<div class="a-shell">

    {{-- ── Sidebar ── --}}
    <aside class="a-sidebar" aria-label="Admin navigation">
        <div class="a-brand">
            <div class="a-brand-mark">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/>
                    <path d="M7 11v5c3 2 7 2 10 0v-5"/>
                </svg>
            </div>
            <div>
                ScholarHunt
                <span class="a-brand-sub">Admin Console</span>
            </div>
        </div>

        <nav aria-label="Admin menu">
            <span class="a-nav-label">Overview</span>
            <a href="{{ route('admin.dashboard') }}"
               class="a-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>

            <span class="a-nav-label">Scholarships</span>
            <a href="{{ route('admin.scholarships.index') }}"
               class="a-nav-item {{ request()->routeIs('admin.scholarships.index') || request()->routeIs('admin.scholarships.edit') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/></svg>
                All Scholarships
            </a>
            <a href="{{ route('admin.scholarships.create') }}"
               class="a-nav-item {{ request()->routeIs('admin.scholarships.create') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>
                Add Scholarship
            </a>

            <span class="a-nav-label">Users</span>
            <a href="{{ route('admin.users.index') }}"
               class="a-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><path d="M16 3.13a4 4 0 0 1 0 7.75M21 21v-2a4 4 0 0 0-3-3.85"/></svg>
                Manage Users
            </a>

            <hr class="a-sidebar-divider">
            <a href="{{ route('dashboard.discover') }}" target="_blank" rel="noopener" class="a-nav-item">
                <svg viewBox="0 0 24 24"><path d="M15 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8"/><path d="m10 12 5-5-5-5M15 12H3"/></svg>
                Student View
            </a>
        </nav>

        <div class="a-sidebar-user">
            @php
                $adminName = auth()->user()->full_name;
                $adminInitials = collect(explode(' ', $adminName))->filter()->map(fn($p) => mb_substr($p,0,1))->take(2)->implode('');
            @endphp
            <div class="a-user-card">
                <div class="a-avatar">{{ $adminInitials ?: 'AD' }}</div>
                <div>
                    <span class="a-user-name">{{ $adminName }}</span>
                    <span class="a-user-role">Administrator</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="a-logout-btn">
                    <svg viewBox="0 0 24 24"><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"/></svg>
                    Log out
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main ── --}}
    <div class="a-main">
        <header class="a-topbar">
            <span class="a-topbar-title">@yield('topbar-title', 'Admin')</span>
            <span class="a-topbar-badge">
                <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2Z"/><path d="M12 8v4l3 3"/></svg>
                {{ now()->format('M d, Y') }}
            </span>
        </header>

        <div class="a-content">
            @if (session('success'))
                <div class="flash flash-success" role="alert">
                    <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="flash flash-error" role="alert">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<div class="confirm-dialog" id="confirm-dialog" role="dialog" aria-modal="true" aria-labelledby="confirm-title">
    <div class="confirm-box">
        <h3 id="confirm-title">Confirm Action</h3>
        <p id="confirm-message">Are you sure you want to proceed?</p>
        <div class="confirm-actions">
            <button type="button" class="btn btn-secondary" id="confirm-cancel">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirm-proceed">Delete</button>
        </div>
    </div>
</div>

<script>
(function () {
    // Generic confirmation dialog wired to forms with data-confirm
    const dialog = document.getElementById('confirm-dialog');
    const msgEl  = document.getElementById('confirm-message');
    const cancel = document.getElementById('confirm-cancel');
    const proceed = document.getElementById('confirm-proceed');
    let pendingForm = null;

    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (!form.dataset.confirm) return;
        e.preventDefault();
        pendingForm = form;
        msgEl.textContent = form.dataset.confirm;
        dialog.classList.add('open');
        proceed.focus();
    });
    cancel.addEventListener('click', () => { dialog.classList.remove('open'); pendingForm = null; });
    proceed.addEventListener('click', () => { dialog.classList.remove('open'); if (pendingForm) pendingForm.submit(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') { dialog.classList.remove('open'); pendingForm = null; } });
}());
</script>
@stack('scripts')
</body>
</html>
