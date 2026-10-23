<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#131A28">
    <title>@yield('title', 'Feed') — ScholarHunt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Palette galing sa register page */
        :root{
            --navy:#131A28; --teal:#1F6A8F; --teal-dk:#185877; --steel:#7BA0C0; --mist:#C4D6DE;
            --paper:#F2F7FA; --card:#FFFFFF; --line:#D3E0E8; --muted:#5C748A;
            --error:#C0392B; --success:#1A7A4E; --warn:#9A6A12;
            --shadow-sm:0 1px 3px #131A2812,0 1px 2px #131A280A;
            --shadow-md:0 4px 16px #131A281A,0 1px 4px #131A280D;
            --radius:10px; --radius-sm:6px; --side:252px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{min-height:100vh;font-family:'DM Sans',sans-serif;font-size:15px;line-height:1.6;background:var(--paper);color:var(--navy);-webkit-font-smoothing:antialiased}
        a{color:inherit;text-decoration:none} button,input{font:inherit} button{cursor:pointer}
        h1,h2,h3,.wordmark{font-family:'Manrope',sans-serif}
        :focus-visible{outline:2px solid var(--teal);outline-offset:3px;border-radius:3px}
        svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:1.7;stroke-linecap:round;stroke-linejoin:round;flex:none}

        .app{display:grid;grid-template-columns:var(--side) 1fr;min-height:100svh}
        .sidebar{position:sticky;top:0;height:100svh;background:var(--navy);color:#C2D6E4;padding:28px 18px 20px;display:flex;flex-direction:column;gap:30px;overflow:hidden;isolation:isolate;transition:padding .28s}
        .sidebar::before{content:'';position:absolute;width:360px;height:360px;border-radius:50%;background:radial-gradient(circle,#1F6A8F50,transparent 65%);top:-150px;left:-140px;z-index:-1}
        .sidebar-brand-row{display:flex;align-items:center;justify-content:space-between;gap:8px}
        .wordmark{display:inline-flex;align-items:center;gap:11px;font-weight:800;letter-spacing:-.07em;font-size:21px;color:#E8F1F6;padding:0 8px}
        .brand-mark{width:36px;height:36px;border-radius:50%;background:var(--teal);display:grid;place-items:center;box-shadow:0 0 0 3px #1F6A8F40}
        .brand-mark svg{width:18px;stroke:#fff;stroke-width:1.8}
        .sidebar-collapse-btn{width:34px;height:34px;display:grid;place-items:center;flex:none;border:1px solid #7BA0C033;border-radius:var(--radius-sm);background:#ffffff08;color:#A9C2D4;transition:background .2s,color .2s,transform .28s}
        .sidebar-collapse-btn:hover{background:#ffffff16;color:#fff}
        .sidebar-collapse-btn svg{width:17px;height:17px}
        .nav{display:grid;gap:4px}
        .nav a{display:flex;align-items:center;gap:13px;padding:11px 12px;border-radius:var(--radius-sm);font-size:14px;font-weight:500;color:#A9C2D4;transition:background .2s,color .2s}
        .nav a:hover{background:#ffffff0F;color:#fff}
        .nav a[aria-current="page"]{background:var(--teal);color:#fff;font-weight:700}
        .sidebar-footer{margin-top:auto;display:grid;gap:8px}
        .side-account{display:flex;flex-direction:column-reverse;gap:8px;min-width:0}
        .side-account summary{list-style:none;cursor:pointer}
        .side-account summary::-webkit-details-marker{display:none}
        .side-user{display:flex;align-items:center;gap:12px;padding:12px;border:1px solid #7BA0C026;border-radius:var(--radius);background:#ffffff08;transition:background .2s}
        .side-user:hover{background:#ffffff12}
        .account-chevron{width:15px;height:15px;margin-left:auto;color:#7BA0C0;transition:transform .2s}
        .side-account[open] .account-chevron{transform:rotate(180deg)}
        .avatar{width:36px;height:36px;border-radius:50%;background:var(--mist);color:var(--navy);display:grid;place-items:center;font:800 13px 'Manrope',sans-serif;flex:none}
        .side-user strong{display:block;font-size:13px;color:#E8F1F6;line-height:1.3}
        .side-user small{font-size:11.5px;color:#7BA0C0}
        .side-account-menu{display:grid;gap:4px;padding:7px;border:1px solid #7BA0C026;border-radius:var(--radius);background:#182435;box-shadow:0 8px 22px #0003}
        .side-account-profile{display:grid;gap:3px;padding:9px;border-radius:var(--radius-sm);color:#E8F1F6;transition:background .2s}
        .side-account-profile:hover{background:#ffffff0F}
        .side-account-profile strong{font-size:13px;line-height:1.35;overflow-wrap:anywhere}
        .side-account-profile small{font-size:11px;color:#A9C2D4;overflow-wrap:anywhere}
        .side-account-profile span{font-size:11px;color:#7BA0C0}
        .sidebar-logout button{display:flex;align-items:center;gap:13px;width:100%;padding:11px 12px;border:1px solid transparent;border-radius:var(--radius-sm);background:transparent;color:#A9C2D4;text-align:left;font-size:14px;font-weight:500;transition:background .2s,color .2s}
        .sidebar-logout button:hover{background:#ffffff0F;color:#fff}

        .app,.main{transition:grid-template-columns .28s,padding .28s}
        .app.sidebar-collapsed{grid-template-columns:82px 1fr}
        .app.sidebar-collapsed:has(.side-account[open]){grid-template-columns:var(--side) 1fr}
        .app.sidebar-collapsed .sidebar{padding:24px 12px 20px}
        .app.sidebar-collapsed:has(.side-account[open]) .sidebar{padding:28px 18px 20px}
        .app.sidebar-collapsed .sidebar-brand-row{flex-direction:column}
        .app.sidebar-collapsed:has(.side-account[open]) .sidebar-brand-row{flex-direction:row}
        .app.sidebar-collapsed .wordmark{padding:0}
        .app.sidebar-collapsed .wordmark-label,.app.sidebar-collapsed .nav-label,.app.sidebar-collapsed .side-user-copy,.app.sidebar-collapsed .logout-label{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
        .app.sidebar-collapsed:has(.side-account[open]) .wordmark-label,.app.sidebar-collapsed:has(.side-account[open]) .nav-label,.app.sidebar-collapsed:has(.side-account[open]) .side-user-copy,.app.sidebar-collapsed:has(.side-account[open]) .logout-label{position:static;width:auto;height:auto;padding:0;margin:0;overflow:visible;clip:auto;white-space:normal;border:0}
        .app.sidebar-collapsed .sidebar-collapse-btn svg{transform:rotate(180deg)}
        .app.sidebar-collapsed:has(.side-account[open]) .sidebar-collapse-btn svg{transform:none}
        .app.sidebar-collapsed .nav a,.app.sidebar-collapsed .sidebar-logout button{justify-content:center;padding-inline:0}
        .app.sidebar-collapsed:has(.side-account[open]) .nav a,.app.sidebar-collapsed:has(.side-account[open]) .sidebar-logout button{justify-content:flex-start;padding-inline:12px}
        .app.sidebar-collapsed .nav a{gap:0}
        .app.sidebar-collapsed .side-user{justify-content:center;padding:8px}
        .app.sidebar-collapsed:has(.side-account[open]) .side-user{justify-content:flex-start;padding:12px}
        .main{min-width:0;padding:44px clamp(20px,4.5vw,64px) 60px}
        .page-head h1{font-size:clamp(28px,3.4vw,40px);font-weight:800;letter-spacing:-.07em;line-height:1.12}
        .page-head p{color:var(--muted);margin-top:8px}

        .topbar{display:none}
        .scrim{display:none}
        @media (min-width:901px){.mobile-menu-btn{display:none}}
        @media (max-width:900px){
            .app{grid-template-columns:1fr}
            .app.sidebar-collapsed{grid-template-columns:1fr}
            .app.sidebar-collapsed:has(.side-account[open]){grid-template-columns:1fr}
            .sidebar-collapse-btn{display:none}
            .topbar{display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:30;background:var(--navy);padding:12px 18px;color:#E8F1F6}
            .topbar .wordmark{padding:0;font-size:19px}
            .menu-btn{background:transparent;border:1px solid #7BA0C033;color:#E8F1F6;border-radius:var(--radius-sm);width:40px;height:40px;display:grid;place-items:center}
            .sidebar{position:fixed;z-index:50;left:0;top:0;width:min(290px,84vw);transform:translateX(-102%);transition:transform .3s cubic-bezier(.16,1,.3,1)}
            .sidebar.open{transform:none}
            .scrim{position:fixed;inset:0;z-index:40;background:#131A2899;opacity:0;pointer-events:none;transition:opacity .25s;display:block}
            .scrim.show{opacity:1;pointer-events:auto}
            .main{padding-top:28px}
        }
        @media (prefers-reduced-motion:reduce){*,*::before,*::after{transition-duration:.01ms!important;animation-duration:.01ms!important;scroll-behavior:auto!important}}
    </style>
    @stack('styles')
</head>
<body>
<header class="topbar">
    <span class="wordmark"><span class="brand-mark"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/></svg></span>ScholarHunt</span>
    <button class="menu-btn mobile-menu-btn" id="menu-btn" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="sidebar"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg></button>
</header>
<div class="scrim" id="scrim"></div>

<div class="app">
    <x-sidebar />

    <main class="main">@yield('content')</main>
</div>

<script>
    const app = document.querySelector('.app');
    const sidebar = document.getElementById('sidebar');
    const scrim = document.getElementById('scrim');
    const menuBtn = document.getElementById('menu-btn');
    const collapseBtn = document.getElementById('sidebar-collapse-toggle');
    const mobileViewport = window.matchMedia('(max-width: 900px)');

    function setMobileMenu(open) {
        sidebar.classList.toggle('open', open);
        scrim.classList.toggle('show', open);
        sidebar.inert = !open;
        menuBtn.setAttribute('aria-expanded', String(open));
        menuBtn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    }

    function setDesktopSidebarCollapsed(collapsed) {
        app.classList.toggle('sidebar-collapsed', collapsed);
        collapseBtn.setAttribute('aria-expanded', String(!collapsed));
        collapseBtn.setAttribute('aria-label', collapsed ? 'Expand navigation' : 'Collapse navigation');
        collapseBtn.title = collapsed ? 'Expand navigation' : 'Collapse navigation';
    }

    function syncSidebarForViewport() {
        if (mobileViewport.matches) {
            setMobileMenu(false);
        } else {
            sidebar.classList.remove('open');
            scrim.classList.remove('show');
            sidebar.inert = false;
            menuBtn.setAttribute('aria-expanded', 'false');
            menuBtn.setAttribute('aria-label', 'Open menu');
        }
    }

    menuBtn.addEventListener('click', () => setMobileMenu(!sidebar.classList.contains('open')));
    collapseBtn.addEventListener('click', () => setDesktopSidebarCollapsed(!app.classList.contains('sidebar-collapsed')));
    scrim.addEventListener('click', () => setMobileMenu(false));
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && mobileViewport.matches && sidebar.classList.contains('open')) {
            setMobileMenu(false);
            menuBtn.focus();
        }
    });
    mobileViewport.addEventListener('change', syncSidebarForViewport);
    syncSidebarForViewport();
</script>
@stack('scripts')
</body>
</html>
