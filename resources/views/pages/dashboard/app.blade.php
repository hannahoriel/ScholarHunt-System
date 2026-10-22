<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">\n    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .sidebar{position:sticky;top:0;height:100svh;background:var(--navy);color:#C2D6E4;padding:28px 18px 20px;display:flex;flex-direction:column;gap:30px;overflow:hidden;isolation:isolate}
        .sidebar::before{content:'';position:absolute;width:360px;height:360px;border-radius:50%;background:radial-gradient(circle,#1F6A8F50,transparent 65%);top:-150px;left:-140px;z-index:-1}
        .wordmark{display:inline-flex;align-items:center;gap:11px;font-weight:800;letter-spacing:-.07em;font-size:21px;color:#E8F1F6;padding:0 8px}
        .brand-mark{width:36px;height:36px;border-radius:50%;background:var(--teal);display:grid;place-items:center;box-shadow:0 0 0 3px #1F6A8F40}
        .brand-mark svg{width:18px;stroke:#fff;stroke-width:1.8}
        .nav{display:grid;gap:4px}
        .nav a{display:flex;align-items:center;gap:13px;padding:11px 12px;border-radius:var(--radius-sm);font-size:14px;font-weight:500;color:#A9C2D4;transition:background .2s,color .2s}
        .nav a:hover{background:#ffffff0F;color:#fff}
        .nav a[aria-current="page"]{background:var(--teal);color:#fff;font-weight:700}
        .sidebar-footer{margin-top:auto;display:grid;gap:8px}
        .side-user{display:flex;align-items:center;gap:12px;padding:12px;border:1px solid #7BA0C026;border-radius:var(--radius);background:#ffffff08}
        .avatar{width:36px;height:36px;border-radius:50%;background:var(--mist);color:var(--navy);display:grid;place-items:center;font:800 13px 'Manrope',sans-serif;flex:none}
        .side-user strong{display:block;font-size:13px;color:#E8F1F6;line-height:1.3}
        .side-user small{font-size:11.5px;color:#7BA0C0}
        .sidebar-logout button{display:flex;align-items:center;gap:13px;width:100%;padding:11px 12px;border:1px solid transparent;border-radius:var(--radius-sm);background:transparent;color:#A9C2D4;text-align:left;font-size:14px;font-weight:500;transition:background .2s,color .2s}
        .sidebar-logout button:hover{background:#ffffff0F;color:#fff}

        .main{min-width:0;padding:44px clamp(20px,4.5vw,64px) 60px}
        .page-head h1{font-size:clamp(28px,3.4vw,40px);font-weight:800;letter-spacing:-.07em;line-height:1.12}
        .page-head p{color:var(--muted);margin-top:8px}

        .topbar{display:none}
        .scrim{display:none}
        @media (max-width:900px){
            .app{grid-template-columns:1fr}
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
    <button class="menu-btn" id="menu-btn" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="sidebar"><svg viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></svg></button>
</header>
<div class="scrim" id="scrim"></div>

<div class="app">
    <x-sidebar />

    <main class="main">@yield('content')</main>
</div>

<script>
    const sidebar = document.getElementById('sidebar'), scrim = document.getElementById('scrim'), menuBtn = document.getElementById('menu-btn');
    function setMenu(open){ sidebar.classList.toggle('open', open); scrim.classList.toggle('show', open); menuBtn.setAttribute('aria-expanded', String(open)); }
    menuBtn.addEventListener('click', () => setMenu(!sidebar.classList.contains('open')));
    scrim.addEventListener('click', () => setMenu(false));
    document.addEventListener('keydown', e => { if (e.key === 'Escape') setMenu(false); });
</script>
@stack('scripts')
</body>
</html>
