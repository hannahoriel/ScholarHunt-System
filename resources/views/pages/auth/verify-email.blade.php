<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#131A28">
    <title>Verify your email — ScholarHunt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Manrope:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:   #131A28;
            --teal:   #1F6A8F;
            --teal-dk:#185877;
            --steel:  #7BA0C0;
            --mist:   #C4D6DE;
            --paper:  #F2F7FA;
            --card:   #FFFFFF;
            --line:   #D3E0E8;
            --muted:  #5C748A;
            --error:  #C0392B;
            --shadow-sm: 0 1px 3px #131A2812, 0 1px 2px #131A280A;
            --shadow-md: 0 4px 16px #131A281A, 0 1px 4px #131A280D;
            --shadow-lg: 0 12px 40px #1F6A8F22, 0 4px 12px #131A2812;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            min-height: 100svh;
            font-family: 'DM Sans', sans-serif;
            background: var(--paper);
            color: var(--navy);
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
        }
        a { color: inherit; text-decoration: none; }
        h1, h2, h3, .wordmark { font-family: 'Manrope', sans-serif; }
        :focus-visible { outline: 2px solid var(--teal); outline-offset: 3px; border-radius: 3px; }

        /* ── Top bar ── */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px clamp(20px, 5vw, 56px);
            border-bottom: 1px solid var(--line);
            background: var(--card);
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
        }
        .wordmark {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            font-weight: 800;
            letter-spacing: -.07em;
            font-size: 21px;
            color: var(--navy);
        }
        .brand-mark {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: var(--teal);
            display: grid;
            place-items: center;
            box-shadow: 0 0 0 3px #1F6A8F28;
        }
        .brand-mark svg {
            width: 20px;
            fill: none;
            stroke: #fff;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .topbar-action {
            font-size: 12.5px;
            color: var(--muted);
        }
        .topbar-action form { display: inline; }
        .logout-btn {
            background: none;
            border: 1.5px solid var(--line);
            border-radius: 100px;
            padding: 7px 16px;
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            cursor: pointer;
            transition: border-color .2s, color .2s;
            font-family: inherit;
        }
        .logout-btn:hover { border-color: var(--steel); color: var(--navy); }

        /* ── Main content ── */
        .page-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 20px;
        }
        .verify-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: clamp(36px, 5vw, 56px) clamp(28px, 5vw, 56px);
            max-width: 520px;
            width: 100%;
            box-shadow: var(--shadow-lg);
            text-align: center;
            animation: comeUp .65s cubic-bezier(.16,1,.3,1) both;
        }

        /* Icon */
        .envelope-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px; height: 72px;
            border-radius: 18px;
            background: linear-gradient(135deg, #1F6A8F18, #7BA0C018);
            border: 1.5px solid #C4D6DE;
            margin-bottom: 28px;
        }
        .envelope-icon svg {
            width: 34px; height: 34px;
            fill: none;
            stroke: var(--teal);
            stroke-width: 1.6;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .verify-card h1 {
            font-size: clamp(24px, 3vw, 32px);
            font-weight: 800;
            letter-spacing: -.065em;
            line-height: 1.15;
            margin-bottom: 14px;
            color: var(--navy);
        }
        .verify-card p {
            font-size: 14.5px;
            line-height: 1.8;
            color: var(--muted);
            margin-bottom: 8px;
        }
        .verify-card .email-pill {
            display: inline-block;
            background: #E6F2F9;
            border: 1px solid #BDD5E4;
            border-radius: 100px;
            padding: 5px 16px;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--teal);
            margin: 4px 0 28px;
            word-break: break-all;
        }

        /* Divider */
        .divider {
            height: 1px;
            background: var(--line);
            margin: 28px 0;
        }

        /* Alert banners */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 13px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            line-height: 1.6;
            margin-bottom: 22px;
            text-align: left;
        }
        .alert-success {
            background: #E4F3EC;
            border: 1px solid #B3DEC8;
            color: #1A5C38;
        }
        .alert-success::before { content: '✓'; font-weight: 800; color: #1A7A4E; flex-shrink: 0; margin-top: 1px; }
        .alert-info {
            background: #E4F0F7;
            border: 1px solid #BDD5E4;
            color: var(--navy);
        }
        .alert-info::before { content: 'ℹ'; flex-shrink: 0; color: var(--teal); margin-top: 1px; }

        /* Steps list */
        .steps {
            list-style: none;
            text-align: left;
            display: grid;
            gap: 12px;
            margin-bottom: 28px;
        }
        .steps li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 13.5px;
            color: var(--muted);
            line-height: 1.55;
        }
        .step-num {
            flex-shrink: 0;
            width: 24px; height: 24px;
            border-radius: 50%;
            background: var(--teal);
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            display: grid;
            place-items: center;
            margin-top: 1px;
        }

        /* Resend form */
        .resend-form { margin-bottom: 20px; }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            height: 52px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
            box-shadow: var(--shadow-md);
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--teal);
            transform: translateX(-101%);
            transition: transform .4s cubic-bezier(.16,1,.3,1);
        }
        .btn-primary:hover::before { transform: translateX(0); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 28px #1F6A8F38; }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary span { position: relative; z-index: 1; }

        .hint-text {
            font-size: 12px;
            color: #8AABBF;
            line-height: 1.65;
        }
        .hint-text a { color: var(--teal); font-weight: 700; }
        .hint-text a:hover { text-decoration: underline; text-underline-offset: 3px; }

        /* ── Footer ── */
        .page-footer {
            text-align: center;
            padding: 20px;
            font-size: 11.5px;
            color: #8AABBF;
            border-top: 1px solid var(--line);
            flex-shrink: 0;
        }

        @keyframes comeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>

    <!-- Top bar -->
    <header class="topbar">
        <a class="wordmark" href="{{ route('landing') }}" aria-label="ScholarHunt home">
            <span class="brand-mark">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/>
                    <path d="M7 11v5c3 2 7 2 10 0v-5"/>
                </svg>
            </span>
            ScholarHunt
        </a>
        <div class="topbar-action">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn" type="submit">Sign out</button>
            </form>
        </div>
    </header>

    <!-- Body -->
    <main class="page-body">
        <div class="verify-card" role="main" aria-labelledby="verify-title">

            <!-- Icon -->
            <div class="envelope-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="m2 7 10 7 10-7"/>
                </svg>
            </div>

            <h1 id="verify-title">Check your inbox</h1>
            <p>We sent a verification link to:</p>
            <span class="email-pill">{{ $email }}</span>

            {{-- Success: link was resent --}}
            @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success" role="status">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            {{-- Info: general status message --}}
            @if (session('status') && session('status') !== 'verification-link-sent')
                <div class="alert alert-info" role="status">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Steps -->
            <ol class="steps" aria-label="What to do next">
                <li>
                    <span class="step-num" aria-hidden="true">1</span>
                    <span>Open the email from <strong>ScholarHunt</strong> in your inbox (check your spam folder too).</span>
                </li>
                <li>
                    <span class="step-num" aria-hidden="true">2</span>
                    <span>Click the <strong>Verify my email address</strong> button inside.</span>
                </li>
                <li>
                    <span class="step-num" aria-hidden="true">3</span>
                    <span>You'll be taken straight to your ScholarHunt dashboard — all set!</span>
                </li>
            </ol>

            <div class="divider" role="separator"></div>

            <!-- Resend -->
            <p style="font-size:13.5px;color:var(--muted);margin-bottom:16px;">
                Didn't get the email? We can send it again.
            </p>
            <form method="POST" action="{{ route('verification.send') }}" class="resend-form">
                @csrf
                <button class="btn-primary" type="submit">
                    <span>Resend verification email</span>
                </button>
            </form>

            <p class="hint-text">
                Wrong email address?
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign out
                </a>
                and register again with the correct one.
            </p>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none">@csrf</form>

        </div>
    </main>

    <!-- Footer -->
    <footer class="page-footer">
        © {{ date('Y') }} ScholarHunt &nbsp;·&nbsp;
        <a href="{{ route('landing') }}" style="color:var(--teal);font-weight:600;">Return to homepage</a>
    </footer>

</body>
</html>
