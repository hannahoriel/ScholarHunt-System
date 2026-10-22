<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#131A28">
    <title>Dashboard — ScholarHunt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Manrope:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:#131A28; --teal:#1F6A8F; --steel:#7BA0C0; --mist:#C4D6DE;
            --paper:#F2F7FA; --card:#FFFFFF; --line:#D3E0E8; --muted:#5C748A;
            --shadow-sm:0 1px 3px #131A2812,0 1px 2px #131A280A;
            --shadow-md:0 4px 16px #131A281A,0 1px 4px #131A280D;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{min-height:100svh;font-family:'DM Sans',sans-serif;background:var(--paper);color:var(--navy);-webkit-font-smoothing:antialiased;display:flex;flex-direction:column}
        a{color:inherit;text-decoration:none}
        h1,h2,.wordmark{font-family:'Manrope',sans-serif}
        :focus-visible{outline:2px solid var(--teal);outline-offset:3px;border-radius:3px}

        /* ── Nav ── */
        .navbar{display:flex;align-items:center;justify-content:space-between;padding:18px clamp(20px,5vw,56px);background:var(--card);border-bottom:1px solid var(--line);box-shadow:var(--shadow-sm)}
        .wordmark{display:inline-flex;align-items:center;gap:11px;font-weight:800;letter-spacing:-.07em;font-size:21px}
        .brand-mark{width:38px;height:38px;border-radius:50%;background:var(--teal);display:grid;place-items:center;box-shadow:0 0 0 3px #1F6A8F28}
        .brand-mark svg{width:20px;fill:none;stroke:#fff;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
        .nav-right{display:flex;align-items:center;gap:16px}
        .nav-user{font-size:13px;color:var(--muted);font-weight:500}
        .nav-user strong{color:var(--navy);font-weight:700}
        .btn-logout{background:none;border:1.5px solid var(--line);border-radius:100px;padding:7px 16px;font-size:12px;font-weight:700;color:var(--muted);cursor:pointer;transition:border-color .2s,color .2s;font-family:inherit}
        .btn-logout:hover{border-color:var(--steel);color:var(--navy)}

        /* ── Hero ── */
        .hero{padding:52px clamp(20px,5vw,56px) 40px;max-width:1080px;margin:0 auto;width:100%}
        .hero-badge{display:inline-flex;align-items:center;gap:8px;background:#E4F3EC;border:1px solid #B3DEC8;border-radius:100px;padding:5px 14px;font-size:11.5px;font-weight:700;color:#1A5C38;margin-bottom:20px}
        .hero-badge::before{content:'✓';font-size:12px}
        .hero h1{font-size:clamp(28px,3.5vw,42px);font-weight:800;letter-spacing:-.07em;line-height:1.15;margin-bottom:12px}
        .hero h1 span{color:var(--teal)}
        .hero p{font-size:15px;color:var(--muted);line-height:1.75;max-width:520px}

        /* ── Stats ── */
        .stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;padding:0 clamp(20px,5vw,56px) 32px;max-width:1080px;margin:0 auto;width:100%}
        .stat-card{background:var(--card);border:1px solid var(--line);border-radius:12px;padding:22px 24px;box-shadow:var(--shadow-sm)}
        .stat-card .label{font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);margin-bottom:10px}
        .stat-card .value{font-family:'Manrope',sans-serif;font-size:32px;font-weight:800;letter-spacing:-.06em;color:var(--navy)}
        .stat-card .value span{font-size:16px;color:var(--teal);font-weight:700;margin-left:4px}

        /* ── Profile summary card ── */
        .content{padding:0 clamp(20px,5vw,56px) 52px;max-width:1080px;margin:0 auto;width:100%}
        .section-heading{font-family:'Manrope',sans-serif;font-size:16px;font-weight:800;letter-spacing:-.04em;margin-bottom:16px;color:var(--navy)}
        .profile-card{background:var(--card);border:1px solid var(--line);border-radius:14px;padding:28px;box-shadow:var(--shadow-md);display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px 28px}
        .profile-field .field-label{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:5px}
        .profile-field .field-value{font-size:14.5px;font-weight:600;color:var(--navy)}

        /* ── Coming soon banner ── */
        .coming-soon{background:linear-gradient(135deg,var(--navy),#1A2E48);border-radius:14px;padding:32px 32px;margin-top:24px;color:#E8F1F6;display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap}
        .coming-soon h3{font-family:'Manrope',sans-serif;font-size:20px;font-weight:800;letter-spacing:-.05em;margin-bottom:6px}
        .coming-soon p{font-size:13.5px;color:#96B5CA;line-height:1.7;max-width:380px}
        .coming-soon-badge{display:inline-flex;align-items:center;gap:8px;background:#1F6A8F40;border:1px solid #1F6A8F70;border-radius:100px;padding:7px 18px;font-size:12px;font-weight:700;color:var(--mist);white-space:nowrap}

        footer{text-align:center;padding:20px;font-size:11.5px;color:#8AABBF;border-top:1px solid var(--line);margin-top:auto}
        footer a{color:var(--teal);font-weight:600}
        @keyframes comeUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)}}
        .hero,.stats,.content{animation:comeUp .65s cubic-bezier(.16,1,.3,1) both}
        .stats{animation-delay:.05s}.content{animation-delay:.1s}
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important}}
    </style>
</head>
<body>

    <nav class="navbar">
        <a class="wordmark" href="{{ route('dashboard') }}" aria-label="ScholarHunt">
            <span class="brand-mark">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/>
                    <path d="M7 11v5c3 2 7 2 10 0v-5"/>
                </svg>
            </span>
            ScholarHunt
        </a>
        <div class="nav-right">
            <span class="nav-user">
                Hello, <strong>{{ $user->first_name }}</strong>
            </span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button class="btn-logout" type="submit">Sign out</button>
            </form>
        </div>
    </nav>

    <section class="hero">
        <h1>Welcome back, <span>{{ $user->first_name }}</span>.</h1>
        <p>Your ScholarHunt account is active. Scholarship discovery features are coming soon.</p>
    </section>

    <section class="stats" aria-label="Quick stats">
        <div class="stat-card">
            <div class="label">Scholarships matched</div>
            <div class="value">0 <span>available</span></div>
        </div>
        <div class="stat-card">
            <div class="label">Applications tracked</div>
            <div class="value">0</div>
        </div>
        <div class="stat-card">
            <div class="label">Upcoming deadlines</div>
            <div class="value">0</div>
        </div>
    </section>

    <div class="content">
        <h2 class="section-heading">Your profile</h2>
        <div class="profile-card" aria-label="Profile summary">
            <div class="profile-field">
                <div class="field-label">Full name</div>
                <div class="field-value">{{ $user->full_name }}</div>
            </div>
            <div class="profile-field">
                <div class="field-label">Email</div>
                <div class="field-value">{{ $user->email }}</div>
            </div>
            <div class="profile-field">
                <div class="field-label">Contact</div>
                <div class="field-value">{{ $user->contact_number }}</div>
            </div>
            <div class="profile-field">
                <div class="field-label">Education level</div>
                <div class="field-value">{{ $user->education_level === 'shs' ? 'Senior High School' : 'College' }}</div>
            </div>
            <div class="profile-field">
                <div class="field-label">School</div>
                <div class="field-value">{{ $user->school_name }}</div>
            </div>
            <div class="profile-field">
                <div class="field-label">Location</div>
                <div class="field-value">{{ $user->address_city }}, {{ $user->address_province }}</div>
            </div>
        </div>

        <div class="coming-soon">
            <div>
                <h3>Scholarships are on the way.</h3>
                <p>We're building the full discovery engine — matched listings, deadline tracking, and requirement checklists. Check back soon.</p>
            </div>
            <span class="coming-soon-badge">
                🚀&nbsp; Coming soon
            </span>
        </div>
    </div>

    <footer>
        © {{ date('Y') }} ScholarHunt &nbsp;·&nbsp;
        <a href="{{ route('landing') }}">Homepage</a>
    </footer>

</body>
</html>
