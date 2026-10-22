<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#26261C">
    <title>Log in — ScholarHunt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
      // Mark the incoming page before it renders to prevent a second green flash.
      try {
        const direction = sessionStorage.getItem('scholarhunt-page-transition');
        if (direction === 'up' || direction === 'down') {
          document.documentElement.classList.add('sh-arriving');
          document.documentElement.classList.toggle('sh-down', direction === 'down');
        }
      } catch (_) {}
    </script>
    <style>
        :root{--brown:#2B1B16;--olive:#26261C;--sage:#7A6F5E;--plum:#4D2F32;--black:#0D0D0D;--paper:#F7F5F0;--cream:#EBE6DD;--line:#DCD5C9;--muted:#716A62}
        *{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;min-height:100vh;font-family:'DM Sans',sans-serif;background:var(--paper);color:var(--brown);-webkit-font-smoothing:antialiased}a{color:inherit;text-decoration:none}button,input{font:inherit}button{cursor:pointer}h1,h2,.wordmark{font-family:'Manrope',sans-serif}button:focus-visible,a:focus-visible,input:focus-visible{outline:2px solid var(--plum);outline-offset:3px}
        .auth-shell{display:grid;grid-template-columns:minmax(340px,44%) 1fr;min-height:100svh}
        .brand-side{position:relative;background:var(--olive);color:var(--paper);padding:35px clamp(30px,4.5vw,75px);display:flex;flex-direction:column;justify-content:space-between;overflow:hidden;isolation:isolate}
        .brand-side::before{content:'';position:absolute;inset:auto -20% -42% -20%;height:75%;border:1px solid #F7F5F027;border-radius:50%;transform:rotate(-18deg);pointer-events:none}
        .brand-side::after{content:'';position:absolute;right:-18%;bottom:-43%;width:85%;aspect-ratio:1;border:1px solid #F7F5F022;border-radius:50%;pointer-events:none}
        .wordmark{display:inline-flex;align-items:center;gap:11px;font-weight:800;letter-spacing:-.07em;font-size:24px;width:max-content}.brand-mark{width:37px;height:37px;border-radius:50%;background:var(--paper);color:var(--brown);display:grid;place-items:center}.brand-mark svg{width:21px;fill:none;stroke:currentColor;stroke-width:1.7;stroke-linecap:round;stroke-linejoin:round}
        .side-content{position:relative;z-index:1;max-width:445px;padding:30px 0}.eyebrow{display:flex;align-items:center;gap:11px;font-size:11px;letter-spacing:.13em;text-transform:uppercase;font-weight:700;color:#C7BEAF}.eyebrow::before{content:'';width:21px;height:1px;background:#C7BEAF}.side-content h2{font-size:clamp(34px,3.45vw,56px);line-height:1.13;letter-spacing:-.065em;font-weight:700;margin:28px 0 24px}.side-content p{max-width:345px;color:#D0C9BC;font-size:14px;line-height:1.9;margin:0}.side-footer{font-size:12px;color:#C5BBAB;position:relative;z-index:1}
        .auth-main{display:flex;flex-direction:column;padding:31px clamp(26px,5vw,90px) 24px;min-width:0}.top-nav{display:flex;align-items:center;justify-content:flex-end;gap:12px;font-size:12px;font-weight:700}.top-nav span{color:var(--muted);font-weight:500}.top-nav a{border-bottom:1px solid var(--brown);padding-bottom:4px;transition:color .25s,border-color .25s}.top-nav a:hover{color:var(--plum);border-color:var(--plum)}
        .form-layout{width:min(100%,430px);margin:auto; padding:65px 0 55px;animation:comeUp .8s cubic-bezier(.16,1,.3,1) both}.welcome-label{text-transform:uppercase;letter-spacing:.16em;font-size:10px;font-weight:800;color:var(--sage);margin:0 0 18px}.form-layout h1{font-size:clamp(34px,4vw,52px);font-weight:800;letter-spacing:-.075em;line-height:1.15;margin:0 0 12px}.subtitle{font-size:14px;line-height:1.8;color:var(--muted);margin:0 0 39px}.field{margin:0 0 22px}.field label{display:block;font-size:12px;font-weight:700;margin-bottom:10px}.field input{width:100%;height:54px;border:1px solid #CAC1B5;background:#FFFDFC;border-radius:5px;padding:0 17px;color:var(--brown);font-size:14px;transition:border .25s,box-shadow .25s,transform .25s}.field input:hover{border-color:var(--sage)}.field input:focus{outline:0;border-color:var(--plum);box-shadow:0 0 0 4px #4D2F3217;transform:translateY(-1px)}.field input::placeholder{color:#9A9187}.password-wrap{position:relative}.password-wrap input{padding-right:72px}.show-pass{position:absolute;right:13px;top:50%;transform:translateY(-50%);border:0;background:transparent;padding:8px 4px;font-size:12px;color:var(--sage);font-weight:700}.show-pass:hover{color:var(--brown)}.form-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;margin:1px 0 29px;font-size:12px}.remember{display:inline-flex;gap:9px;align-items:center;cursor:pointer}.remember input{accent-color:var(--olive);width:15px;height:15px}.subtle-link{color:var(--plum);font-weight:700;transition:opacity .25s}.subtle-link:hover{opacity:.65;text-decoration:underline;text-underline-offset:4px}
        .submit-btn{position:relative;display:flex;align-items:center;justify-content:space-between;width:100%;height:55px;background:var(--brown);color:var(--paper);border:1px solid var(--brown);border-radius:5px;padding:0 20px;font-size:13px;font-weight:700;overflow:hidden;transition:background .3s,transform .3s,box-shadow .3s}.submit-btn::before{content:'';position:absolute;inset:0;background:var(--olive);transform:translateX(-101%);transition:transform .45s cubic-bezier(.16,1,.3,1)}.submit-btn:hover::before{transform:translateX(0)}.submit-btn:hover{transform:translateY(-3px);box-shadow:0 13px 25px #2B1B1625}.submit-btn:active{transform:translateY(0)}.submit-btn span{position:relative;z-index:1}.submit-btn .arrow{transition:transform .3s}.submit-btn:hover .arrow{transform:translate(3px,-3px)}.bottom-hint{font-size:12px;color:var(--muted);line-height:1.7;text-align:center;margin:25px 0 0}.bottom-hint a{color:var(--plum);font-weight:800}.bottom-hint a:hover{text-decoration:underline}.bottom-meta{font-size:11px;color:var(--muted);display:flex;justify-content:space-between;gap:12px}.bottom-meta a:hover{text-decoration:underline}
        .form-notice{border-left:3px solid var(--sage);padding:10px 12px;background:#EBE6DD;margin:0 0 21px;font-size:12px;line-height:1.65;color:var(--brown)}.back-mobile{display:none}
        .page-wipe{position:fixed;z-index:9999;inset:0;background:var(--olive);transform:translateY(101%);pointer-events:none;display:grid;place-items:center;color:var(--paper);font:800 25px 'Manrope',sans-serif;letter-spacing:-.07em;transition:transform .5s cubic-bezier(.76,0,.24,1)}.page-wipe.is-leaving{transform:translateY(0)}.page-wipe.is-entering{transform:translateY(-101%)}
        @keyframes comeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
        @media(min-width:901px){.side-content{animation:comeUp .9s .1s both}}
        @media(max-width:900px){.auth-shell{grid-template-columns:1fr}.brand-side{padding:20px 26px;min-height:auto}.brand-side .side-content,.brand-side .side-footer{display:none}.brand-side::before,.brand-side::after{display:none}.wordmark{font-size:20px}.brand-mark{width:32px;height:32px}.auth-main{min-height:calc(100svh - 72px);padding:23px 25px}.top-nav{justify-content:space-between}.back-mobile{display:inline-flex;color:var(--sage);font-weight:600}.form-layout{padding:50px 0}.bottom-meta{padding-bottom:4px}}
        @media(max-width:420px){.top-nav span{display:none}.top-nav{gap:10px}.form-layout h1{font-size:37px}.form-layout{padding:40px 0}.subtitle{margin-bottom:28px}.bottom-meta{font-size:10px}}
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important;scroll-behavior:auto!important}.page-wipe{display:none}}

        /* ScholarHunt page transition: panel and wordmark move together. */
        .page-wipe {
            --wipe-from: 100%;
            --wipe-to: -100%;
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: grid;
            place-items: center;
            background: #26261C;
            color: #F7F5F0;
            transform: translate3d(0, var(--wipe-from), 0);
            transition: transform 700ms cubic-bezier(.76, 0, .24, 1) !important;
            pointer-events: none;
            will-change: transform;
        }
        html.sh-down .page-wipe { --wipe-from: -100%; --wipe-to: 100%; }
        /* On arrival, the destination initially stays behind the fully covering panel. */
        html.sh-arriving .page-wipe {
            transform: translate3d(0, 0, 0);
            transition: none !important;
        }
        .page-wipe.is-leaving { transform: translate3d(0, 0, 0); }
        .page-wipe.is-entering { transform: translate3d(0, var(--wipe-to), 0); }
        .page-wipe-wordmark {
            display: block;
            width: max-content;
            white-space: nowrap;
            font-family: Arial, Helvetica, sans-serif;
            font-size: clamp(19px, 2.1vw, 24px);
            font-weight: 700;
            letter-spacing: -.045em;
            line-height: 1;
            color: #F7F5F0;
            /* No independent text transform, animation, or transition. */
        }
        .page-wipe-wordmark .dot { color: #B7A38C; }
        @media (prefers-reduced-motion: reduce) { .page-wipe { display: none !important; } }
    </style>
</head>
<body>
    <div class="page-wipe" id="page-wipe" aria-hidden="true"><span class="page-wipe-wordmark">ScholarHunt<span class="dot">.</span></span></div>
    <div class="auth-shell">
        <aside class="brand-side" aria-label="ScholarHunt introduction">
            <a class="wordmark" href="{{ route('landing') }}" aria-label="ScholarHunt home">
                <span class="brand-mark"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/></svg></span>ScholarHunt
            </a>
            <div class="side-content">
                <span class="eyebrow">A simpler way to discover</span>
                <h2>Your next opportunity starts here.</h2>
                <p>Discover scholarship announcements, keep your requirements organized, and stay on top of approaching deadlines.</p>
            </div>
            <div class="side-footer">Find opportunities. Follow your progress.</div>
        </aside>
        <main class="auth-main">
            <nav class="top-nav" aria-label="Account navigation">
                <a href="{{ route('landing') }}" class="back-mobile">← Back to home</a>
                <span>New to ScholarHunt?</span>
                <a href="{{ url('/register') }}">Create an account ↗</a>
            </nav>
            <section class="form-layout" aria-labelledby="login-title">
                <p class="welcome-label">Welcome back / ScholarHunt</p>
                <h1 id="login-title">Log in.</h1>
                <p class="subtitle">Pick up where you left off. Your scholarship journey is waiting.</p>
                @if ($errors->any())
                    <div class="form-notice" role="alert">{{ $errors->first() }}</div>
                @endif
                @if (session('status'))
                    <div class="form-notice" role="status">{{ session('status') }}</div>
                @endif
                <form method="POST" action="{{ route('login.submit') }}" id="login-form">
                    @csrf
                    <div class="field">
                        <label for="email">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="username" placeholder="you@example.com" value="{{ old('email') }}" required maxlength="254">
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <div class="password-wrap"><input id="password" name="password" type="password" autocomplete="current-password" placeholder="Enter your password" required><button class="show-pass" type="button" id="toggle-password" aria-label="Show password" aria-pressed="false">Show</button></div>
                    </div>
                    <div class="form-tools">
                        <label class="remember"><input name="remember" type="checkbox" value="1"> Remember me</label>
                        <a href="{{ url('/forgot-password') }}" class="subtle-link">Forgot password?</a>
                    </div>
                    <button class="submit-btn" type="submit"><span>Log in to ScholarHunt</span><span class="arrow" aria-hidden="true">↗</span></button>
                </form>
                <div class="form-notice" role="note" style="margin-top:22px">
                    <strong>Demo account</strong><br>
                    Email: demo@scholarhunt.test<br>
                    Password: demo1234
                </div>
                <p class="bottom-hint">Don't have an account yet? <a href="{{ url('/register') }}">Sign up</a></p>
            </section>
            <div class="bottom-meta"><span>© {{ date('Y') }} ScholarHunt</span><a href="{{ route('landing') }}">← Return to homepage</a></div>
        </main>
    </div>
    <script>
      (() => {
        const wipe = document.getElementById('page-wipe');
        const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        // Landing -> Login: up / up. Login -> Landing: down / down.
        // Only the panel moves: the wordmark remains centered inside it.
        if (!reduced) {
            const wipe = document.getElementById('page-wipe');
            const root = document.documentElement;
            const key = 'scholarhunt-page-transition';
            const duration = 700;
            let navigating = false;

            if (root.classList.contains('sh-arriving')) {
                try { sessionStorage.removeItem(key); } catch (_) {}
                // Start on the covered frame; then move in the SAME direction to reveal.
                requestAnimationFrame(() => requestAnimationFrame(() => {
                    root.classList.remove('sh-arriving');
                    wipe.classList.add('is-entering');
                }));
            }

            document.querySelectorAll('a[href]').forEach(link => link.addEventListener('click', event => {
                if (navigating || event.defaultPrevented || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey || event.button !== 0 || link.target === '_blank' || link.hasAttribute('download')) return;
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#')) return;
                const target = new URL(link.href, location.href);
                const currentPath = location.pathname.replace(/\/$/, '') || '/';
                const targetPath = target.pathname.replace(/\/$/, '') || '/';
                if (target.origin !== location.origin || !['/', '/login'].includes(currentPath) || !['/', '/login'].includes(targetPath) || targetPath === currentPath) return;
                event.preventDefault();
                navigating = true;
                const direction = currentPath === '/login' ? 'down' : 'up';
                root.classList.toggle('sh-down', direction === 'down');
                wipe.style.transition = 'none';
                wipe.classList.remove('is-entering', 'is-leaving');
                void wipe.offsetHeight;
                wipe.style.transition = '';
                try { sessionStorage.setItem(key, direction); } catch (_) {}
                requestAnimationFrame(() => requestAnimationFrame(() => {
                    wipe.classList.add('is-leaving');
                    window.setTimeout(() => location.assign(target.href), duration + 35);
                }));
            }));
            window.addEventListener('pageshow', event => {
                if (event.persisted) {
                    root.classList.remove('sh-arriving');
                    wipe.classList.remove('is-entering', 'is-leaving');
                    navigating = false;
                }
            });
        }
        const toggle = document.getElementById('toggle-password');
        const password = document.getElementById('password');
        toggle.addEventListener('click', () => {
          const visible = password.type === 'password';
          password.type = visible ? 'text' : 'password';
          toggle.textContent = visible ? 'Hide' : 'Show';
          toggle.setAttribute('aria-label', visible ? 'Hide password' : 'Show password');
          toggle.setAttribute('aria-pressed', String(visible));
        });
      })();
    </script>
</body>
</html>
