<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#182B43">
    <meta name="description" content="ScholarHunt brings scholarship opportunities, requirements, and deadlines together for students.">
    <title>ScholarHunt — Find scholarships worth looking into</title>
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
        :root {
            --brown: #182B43;
            --olive: #355D79;
            --sage: #91AEC7;
            --clay: #355D79;
            --black: #182B43;
            --paper: #F5F8FC;
            --cream: #E7EFF7;
            --white: #FFFFFF;
            --line: #D2E2EE;
            --muted: #657C92;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; background: var(--paper); color: var(--brown); font-family: 'DM Sans', sans-serif; -webkit-font-smoothing: antialiased; }
        a { color: inherit; text-decoration: none; }
        button { font: inherit; cursor: pointer; }
        svg { width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 1.6; stroke-linecap: round; stroke-linejoin: round; }
        h1, h2, h3, p { margin-top: 0; }
        h1, h2, h3, .logo { font-family: 'Manrope', sans-serif; }
        .wrap { width: min(1180px, calc(100% - 80px)); margin-inline: auto; }
        .nav-shell { border-bottom: 1px solid var(--line); background: var(--paper); position: relative; z-index: 5; }
        .nav { min-height: 84px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .logo { font-size: 24px; font-weight: 800; letter-spacing: -.08em; display: inline-flex; align-items: center; gap: 10px; white-space: nowrap; }
        .logo-icon { background: var(--brown); color: var(--paper); display: grid; place-items: center; width: 36px; height: 36px; border-radius: 50%; }
        .logo-icon svg { width: 19px; height: 19px; }
        .nav-mid, .nav-end { display: flex; align-items: center; gap: 35px; }
        .nav-mid a, .sign-in { font-size: 13px; font-weight: 700; }
        .nav-mid a:hover, .sign-in:hover { color: var(--clay); text-decoration: underline; text-underline-offset: 5px; }
        .nav-end { gap: 23px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 18px; min-height: 48px; padding: 0 20px; border-radius: 4px; font-size: 13px; font-weight: 700; border: 1px solid transparent; transition: background .2s, transform .2s; white-space: nowrap; }
        .btn:hover { transform: translateY(-1px); }
        .btn-dark { background: var(--brown); color: #fff; }
        .btn-dark:hover { background: var(--clay); }
        .btn-outline { border-color: var(--brown); background: transparent; color: var(--brown); }
        .btn-outline:hover { background: var(--cream); }
        .btn svg { width: 17px; height: 17px; }
        .menu-btn { display: none; background: transparent; border: 0; padding: 8px; }
        .hero { padding: 82px 0 94px; overflow: hidden; }
        .hero-layout { display: grid; grid-template-columns: 1.04fr .96fr; align-items: center; gap: 74px; }
        .topline { color: var(--clay); font-size: 11px; font-weight: 800; letter-spacing: .18em; text-transform: uppercase; display: inline-flex; gap: 12px; align-items: center; }
        .topline:before { content: ''; display: block; background: var(--clay); width: 25px; height: 1px; }
        h1 { font-size: clamp(48px, 5.1vw, 73px); line-height: 1.13; letter-spacing: -.075em; font-weight: 700; margin: 26px 0; max-width: 650px; }
        h1 em { font-style: normal; color: var(--clay); position: relative; }
        .intro { max-width: 470px; color: #5E7387; font-size: 16px; line-height: 1.9; }
        .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; margin: 32px 0 27px; }
        .hero-foot { display: flex; align-items: center; gap: 9px; font-size: 12px; color: var(--muted); }
        .hero-foot svg { width: 17px; height: 17px; color: var(--sage); }
        .showcase { background: var(--olive); min-height: 440px; border-radius: 5px; padding: 27px; position: relative; display: flex; flex-direction: column; justify-content: center; }
        .showcase:after { content: ''; position: absolute; width: 90px; height: 90px; border: 1px solid #D3C7B350; top: -19px; right: -21px; border-radius: 50%; pointer-events: none; }
        .showcase-top { display: flex; align-items: center; justify-content: space-between; color: #E1EBF5; font-size: 12px; margin-bottom: 22px; }
        .showcase-top span:last-child { font-size: 11px; opacity: .7; }
        .demo { background: var(--paper); border-radius: 3px; padding: 27px; box-shadow: 0 18px 42px #00000020; }
        .demo-label { font-size: 10px; text-transform: uppercase; font-weight: 800; letter-spacing: .15em; color: var(--sage); margin-bottom: 10px; }
        .demo h3 { font-size: 22px; letter-spacing: -.05em; margin: 0 0 18px; }
        .search-line { border: 1px solid var(--line); background: #fff; height: 44px; padding: 0 13px; display: flex; align-items: center; gap: 11px; color: #8B8279; font-size: 12px; border-radius: 3px; margin-bottom: 21px; }
        .search-line svg { width: 17px; height: 17px; }
        .demo-row { border-top: 1px solid var(--line); padding: 15px 0; display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: center; }
        .demo-row:last-child { padding-bottom: 0; }
        .demo-row h4 { font-size: 13px; margin: 0 0 5px; font-weight: 700; }
        .demo-row p { margin: 0; font-size: 11px; color: var(--muted); }
        .demo-row svg { width: 16px; height: 16px; color: var(--clay); }
        .demo-note { margin: 20px 0 0; color: #C7D7E6; font-size: 11px; line-height: 1.7; }
        .rule { border-top: 1px solid var(--line); }
        .intro-strip { padding: 25px 0; display: flex; justify-content: space-between; gap: 25px; align-items: center; }
        .intro-strip p { margin: 0; font-size: 13px; color: var(--sage); }
        .intro-strip strong { color: var(--brown); }
        .text-link { font-weight: 700; font-size: 12px; white-space: nowrap; border-bottom: 1px solid var(--brown); padding-bottom: 4px; }
        .text-link:hover { color: var(--clay); }
        section.content { padding: 100px 0; }
        .section-head { display: grid; grid-template-columns: .8fr 1.2fr; align-items: end; gap: 70px; margin-bottom: 48px; }
        .section-head h2 { font-size: clamp(33px, 3.5vw, 48px); line-height: 1.22; letter-spacing: -.06em; font-weight: 700; margin: 17px 0 0; }
        .section-head > p { color: var(--muted); font-size: 15px; line-height: 1.85; max-width: 470px; margin: 0; }
        .features { display: grid; grid-template-columns: repeat(4, 1fr); border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); }
        .feature { padding: 31px 23px 28px 0; }
        .feature + .feature { border-left: 1px solid var(--line); padding-left: 23px; }
        .feature-no { font-family: 'Manrope',sans-serif; font-size: 12px; font-weight: 800; color: var(--sage); display: block; margin-bottom: 41px; }
        .feature svg { width: 27px; height: 27px; margin-bottom: 22px; color: var(--clay); }
        .feature h3 { font-size: 15px; letter-spacing: -.03em; line-height: 1.5; margin-bottom: 11px; }
        .feature p { font-size: 12px; line-height: 1.85; color: var(--muted); margin-bottom: 0; }
        .process { background: var(--cream); padding: 100px 0; }
        .process-head { max-width: 540px; margin-bottom: 42px; }
        .process-head h2 { font-size: clamp(34px, 3.5vw, 48px); letter-spacing: -.06em; line-height: 1.23; margin: 18px 0 0; }
        .steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 45px; }
        .step { border-top: 1px solid #B9CFDF; padding-top: 22px; }
        .step-num { color: var(--clay); font-family: 'Manrope',sans-serif; font-size: 13px; font-weight: 800; display: block; margin-bottom: 47px; }
        .step h3 { font-size: 19px; letter-spacing: -.05em; margin-bottom: 13px; }
        .step p { margin: 0; color: #5E7387; font-size: 13px; line-height: 1.8; max-width: 310px; }
        .last { background: var(--brown); color: #fff; padding: 75px 0; }
        .last-inner { display: flex; justify-content: space-between; align-items: center; gap: 35px; }
        .last h2 { font-size: clamp(29px, 3.6vw, 45px); letter-spacing: -.06em; line-height: 1.2; margin: 0 0 15px; }
        .last p { color: #D6E2EE; font-size: 13px; line-height: 1.85; max-width: 625px; margin: 0; }
        .btn-cream { background: var(--paper); color: var(--brown); }
        .btn-cream:hover { background: var(--cream); }
        footer { padding: 25px 0; background: var(--paper); }
        .footer-inner { display: flex; justify-content: space-between; gap: 20px; align-items: center; }
        .footer-inner .logo { font-size: 19px; }
        .footer-inner .logo-icon { width: 29px; height: 29px; }
        .footer-inner p { margin: 0; font-size: 11px; color: var(--muted); text-align: right; line-height: 1.7; }
        @media (max-width: 960px) { .hero-layout { gap: 40px; } h1 { font-size: 52px; } .nav-mid { gap: 17px; } .features { grid-template-columns: repeat(2, 1fr); } .feature:nth-child(3) { border-left: 0; padding-left: 0; border-top: 1px solid var(--line); } .feature:nth-child(4) { border-top: 1px solid var(--line); } }
        @media (max-width: 720px) {
            .wrap { width: calc(100% - 36px); } .nav { min-height: 70px; } .nav-mid { display: none; position: absolute; top: 70px; left: 0; right: 0; background: var(--paper); border-bottom: 1px solid var(--line); padding: 17px 20px 23px; flex-direction: column; align-items: stretch; gap: 19px; } .nav-mid.open { display: flex; } .sign-in { display: none; } .menu-btn { display: block; } .nav-end { gap: 10px; } .nav-end > .btn { min-height: 40px; padding: 0 13px; }
            .hero { padding: 64px 0 70px; } .hero-layout { grid-template-columns: 1fr; gap: 48px; } h1 { font-size: clamp(42px, 9vw, 60px); } .intro { font-size: 15px; } .showcase { min-height: 0; padding: 20px; } .demo { padding: 21px; } .intro-strip { align-items: flex-start; flex-direction: column; gap: 15px; } section.content, .process { padding: 70px 0; } .section-head { grid-template-columns: 1fr; gap: 20px; } .steps { grid-template-columns: 1fr; gap: 34px; } .step-num { margin-bottom: 25px; } .last-inner { align-items: flex-start; flex-direction: column; } .footer-inner { flex-direction: column; align-items: flex-start; } .footer-inner p { text-align: left; }
        }
        @media (max-width: 450px) { .logo { font-size: 20px; } .logo-icon { width: 31px; height: 31px; } .features { grid-template-columns: 1fr; } .feature, .feature + .feature, .feature:nth-child(3) { padding: 25px 0; border-left: 0; border-top: 1px solid var(--line); } .feature:first-child { border-top: 0; } .feature-no { margin-bottom: 23px; } .hero-actions { flex-direction: column; } .hero-actions .btn { width: 100%; } }
        /* Motion: restrained and purposeful */
        .nav-shell { position: sticky; top: 0; transition: box-shadow .3s ease, background .3s ease; }
        .nav-shell.scrolled { background: rgba(247,245,240,.96); box-shadow: 0 7px 24px rgba(43,27,22,.07); backdrop-filter: blur(12px); }
        .scroll-progress { position: fixed; z-index: 30; top: 0; left: 0; width: 100%; height: 3px; background: var(--clay); transform: scaleX(0); transform-origin: left; pointer-events: none; }
        .nav-mid a { position: relative; transition: color .22s ease; }
        .nav-mid a::after { content: ''; position: absolute; height: 1px; left: 0; bottom: -7px; width: 100%; background: var(--clay); transform: scaleX(0); transform-origin: left; transition: transform .3s ease; }
        .nav-mid a:hover, .nav-mid a:focus-visible { text-decoration: none; }
        .nav-mid a:hover::after, .nav-mid a:focus-visible::after { transform: scaleX(1); }
        .btn { position: relative; overflow: hidden; transition: transform .28s ease, background .28s ease, box-shadow .28s ease; }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(43,27,22,.13); }
        .btn:active { transform: translateY(0) scale(.985); }
        .btn svg, .btn > span { transition: transform .3s ease; }
        .btn:hover svg, .btn:hover > span { transform: translateX(4px); }
        .text-link { transition: color .2s, border-color .2s; }
        .showcase { transition: transform .55s cubic-bezier(.2,.75,.3,1), box-shadow .55s ease; }
        .showcase:hover { transform: translateY(-6px); box-shadow: 0 22px 45px rgba(38,38,28,.16); }
        .demo-row { transition: padding .28s ease, background-color .28s ease; }
        .demo-row:hover { padding-left: 9px; background: rgba(122,111,94,.06); }
        .demo-row svg { transition: transform .3s ease; }
        .demo-row:hover svg { transform: translateX(4px); }
        .search-line { transition: border-color .2s ease, box-shadow .2s ease; }
        .search-line:hover { border-color: var(--sage); box-shadow: 0 0 0 3px rgba(122,111,94,.09); }
        .feature { transition: background-color .3s ease; }
        .feature svg { transition: transform .4s ease; }
        .feature:hover svg { transform: translateY(-5px) rotate(-5deg); }
        .feature:hover h3 { color: var(--clay); }
        .step { transition: border-color .3s ease, transform .3s ease; }
        .step:hover { transform: translateY(-5px); border-color: var(--clay); }
        .hero-layout > :first-child { animation: heroEnter .8s both cubic-bezier(.2,.8,.2,1); }
        .hero-layout > .showcase { animation: heroEnter .9s .14s both cubic-bezier(.2,.8,.2,1); }
        @keyframes heroEnter { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        /* Reveal only after JS enables it, so content stays visible when JS is off */
        .js-motion .reveal { opacity: 0; transform: translateY(26px); transition: opacity .7s ease, transform .7s cubic-bezier(.2,.8,.2,1); }
        .js-motion .reveal.is-visible { opacity: 1; transform: translateY(0); }
        .js-motion .reveal[data-delay="1"] { transition-delay: .09s; }
        .js-motion .reveal[data-delay="2"] { transition-delay: .18s; }
        .js-motion .reveal[data-delay="3"] { transition-delay: .27s; }
        :focus-visible { outline: 2px solid var(--clay); outline-offset: 4px; }
        @media (max-width: 720px) {
          .nav-mid { display: flex; visibility: hidden; opacity: 0; pointer-events: none; transform: translateY(-10px); transition: opacity .22s ease, transform .22s ease, visibility .22s; }
          .nav-mid.open { visibility: visible; opacity: 1; pointer-events: auto; transform: translateY(0); }
          .nav-mid a { padding: 5px 0; }
          .showcase:hover { transform: none; box-shadow: none; }
        }
        @media (prefers-reduced-motion: reduce) {
          *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; scroll-behavior: auto !important; }
          html { scroll-behavior: auto; }
          .js-motion .reveal { opacity: 1; transform: none; }
        }
        /* Enhanced motion language — meaningful movement, not visual noise */
        @keyframes lineDraw { from { transform: scaleX(0); } to { transform: scaleX(1); } }
        @keyframes bob { 0%, 100% { translate: 0 0; } 50% { translate: 0 -8px; } }
        @keyframes softPulse { 0%,100% { box-shadow: 0 0 0 0 rgba(122,111,94,.22); } 50% { box-shadow: 0 0 0 9px rgba(122,111,94,0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateY(10px) scale(.985); } to { opacity:1; transform:translateY(0) scale(1); } }
        @keyframes shimmer { from { transform: translateX(-140%) skewX(-20deg); } to { transform:translateX(330%) skewX(-20deg); } }

        .hero h1 em { white-space: normal; }
        .hero h1 em::after { content:''; height: 7px; background: rgba(122,111,94,.44); position:absolute; bottom:3px; left:0; right:0; z-index:-1; transform-origin:left; animation: lineDraw 1s .85s both cubic-bezier(.16,1,.3,1); border-radius:50%; }
        .hero h1 em { isolation:isolate; }
        .hero-foot svg { animation: softPulse 3s 1s infinite; border-radius:50%; }
        .showcase { isolation:isolate; }
        .showcase::before { content:''; position:absolute; inset:0; border-radius:inherit; pointer-events:none; background:radial-gradient(350px circle at var(--mx,50%) var(--my,45%), rgba(247,245,240,.12), transparent 74%); opacity:0; transition:opacity .35s; }
        .showcase:hover::before { opacity:1; }
        .showcase .demo { position:relative; z-index:1; }
        .showcase-top, .demo-note { position:relative; z-index:1; }
        .demo { transition: transform .45s cubic-bezier(.16,1,.3,1); }
        .showcase:hover .demo { transform: translateY(-3px); }
        .search-line { cursor:text; }
        .search-line input { border:0; background:transparent; min-width:0; width:100%; outline:none; color:var(--brown); font:inherit; font-size:12px; }
        .search-line:focus-within { border-color:var(--clay); box-shadow:0 0 0 4px rgba(77,47,50,.10); }
        .demo-row { cursor:pointer; }
        .demo-row.is-hidden { display:none; }
        .demo-row.is-entering { animation:slideIn .38s both; }
        .demo-empty { display:none; padding:16px 0; font-size:12px; color:var(--muted); }
        .demo-empty.is-visible { display:block; animation:slideIn .3s both; }
        .demo-results { font-size:10px; color:var(--sage); text-align:right; margin:-10px 0 10px; min-height:15px; }
        .eyebrow-dot { display:inline-block; height:7px; width:7px; border-radius:50%; background:#A9A18F; margin-right:9px; animation:softPulse 3s infinite; }
        .feature { position:relative; }
        .feature:after { content:''; position:absolute; top:0; left:0; right:23px; height:2px; background:var(--clay); transform:scaleX(0); transform-origin:left; transition:transform .48s cubic-bezier(.16,1,.3,1); }
        .feature:hover:after { transform:scaleX(1); }
        .step { position:relative; }
        .step::before { content:''; position:absolute; top:-1px; left:0; height:2px; width:100%; background:var(--clay); transform:scaleX(0); transform-origin:left; transition:transform .5s cubic-bezier(.16,1,.3,1); }
        .step:hover::before { transform:scaleX(1); }
        .btn::after { content:''; position:absolute; width:45%; height:150%; top:-25%; left:-55%; background:linear-gradient(90deg,transparent,rgba(255,255,255,.18),transparent); pointer-events:none; transform:skewX(-20deg); }
        .btn:hover::after { animation:shimmer .68s ease both; }
        .nav-mid a.active { color:var(--clay); }
        .nav-mid a.active::after { transform:scaleX(1); }
        .page-wipe { position:fixed; z-index:999; inset:0; background:var(--olive); transform:translateY(101%); pointer-events:none; transition:transform .5s cubic-bezier(.76,0,.24,1); display:flex; align-items:center; justify-content:center; color:var(--paper); font:800 25px 'Manrope',sans-serif; letter-spacing:-.07em; }
        .page-wipe.is-leaving { transform:translateY(0); }
        .page-wipe.is-entering { transform:translateY(-101%); }
        .scroll-cue { display:inline-flex; align-items:center; gap:9px; margin-top:33px; font-size:11px; color:var(--sage); font-weight:700; letter-spacing:.04em; }
        .scroll-cue svg { width:16px; height:16px; animation:bob 2.3s ease-in-out infinite; }
        .back-to-top { position:fixed; bottom:24px; right:24px; width:43px; height:43px; background:var(--brown); color:white; border:1px solid rgba(255,255,255,.15); border-radius:50%; display:grid; place-items:center; opacity:0; pointer-events:none; transform:translateY(14px); transition:opacity .3s,transform .3s,background .3s; z-index:20; box-shadow:0 10px 24px #0002; }
        .back-to-top.show { opacity:1; pointer-events:auto; transform:translateY(0); }
        .back-to-top:hover { background:var(--clay); transform:translateY(-3px); }
        .back-to-top svg { width:18px; height:18px; }
        @media (max-width:720px) { .scroll-cue { margin-top:20px; } .back-to-top { right:16px; bottom:16px; } }
        @media (prefers-reduced-motion:reduce) { .hero h1 em::after { transform:scaleX(1); } .hero-foot svg,.scroll-cue svg { animation:none; } .page-wipe { display:none; } }

        /* Edition 4: scroll-in AND scroll-out motion. The heading has no underline effect. */
        .hero h1 em::after { content: none !important; animation: none !important; }
        .hero h1 em { isolation: auto; }
        .hero-layout > :first-child, .hero-layout > .showcase { animation: none; }
        .js-motion .reveal { opacity: 0; transform: translate3d(0, 42px, 0) scale(.985); filter: blur(4px); transition: opacity .78s cubic-bezier(.2,.7,.2,1), transform .88s cubic-bezier(.16,1,.3,1), filter .78s ease; transition-delay: 0s; will-change: opacity,transform; }
        .js-motion .reveal.is-visible { opacity: 1; transform: translate3d(0,0,0) scale(1); filter: blur(0); }
        .js-motion .reveal[data-delay="1"].is-visible { transition-delay: .10s; }
        .js-motion .reveal[data-delay="2"].is-visible { transition-delay: .20s; }
        .js-motion .reveal[data-delay="3"].is-visible { transition-delay: .30s; }
        /* The second main section contrasts with the light hero. */
        section.content#features { background: var(--olive); color: #FFFFFF; position: relative; overflow: hidden; }
        section.content#features::before { content: ''; position: absolute; width: 430px; height: 430px; border: 1px solid rgba(247,245,240,.13); border-radius: 50%; right: -230px; top: -180px; pointer-events: none; }
        #features .topline, #features .feature-no, #features .feature svg { color: #B5D0E5; }
        #features .topline::before { background: #B5D0E5; }
        #features .section-head > p, #features .feature p { color: #DDE8F1; }
        #features .features { border-color: rgba(247,245,240,.26); }
        #features .feature + .feature { border-color: rgba(247,245,240,.22); }
        #features .feature:after { background: #B5D0E5; }
        #features .feature { transition: background .4s ease, padding .4s ease; }
        #features .feature:hover { background: rgba(247,245,240,.055); }
        #features .feature svg { transition: transform .5s cubic-bezier(.16,1,.3,1); }
        #features .feature:hover svg { transform: rotate(-9deg) translateY(-6px) scale(1.12); }
        .step { transition: transform .5s cubic-bezier(.16,1,.3,1); }
        .step:hover { transform: translateY(-9px); }
        .demo-row { transition: background .3s ease, padding .3s ease, transform .3s ease; }
        .demo-row:hover { transform: translateX(5px); background: rgba(122,111,94,.075); }
        .section-head h2, .process-head h2 { text-wrap: balance; }
        .btn { transition: background .3s, transform .35s cubic-bezier(.16,1,.3,1), box-shadow .3s; }
        .btn:hover { transform: translateY(-4px); box-shadow: 0 11px 24px rgba(13,13,13,.16); }
        .btn svg { transition: transform .3s ease; }
        .btn:hover svg { transform: translateX(5px); }
        .hero, .process, .last { transition: background-color .5s ease; }
        @media (prefers-reduced-motion: reduce) {
          .js-motion .reveal { opacity:1; filter:none; transform:none; transition:none; }
          .hero-layout > :first-child, .hero-layout > .showcase { animation:none; }
          .step:hover, .btn:hover, .demo-row:hover, #features .feature:hover svg { transform:none; }
        }

        /* Full first screen: navbar + hero occupy the initial desktop viewport. */
        @media (min-width: 721px) {
          .hero { min-height: calc(100svh - 84px); display: flex; align-items: center; padding: clamp(20px, 3vh, 42px) 0; }
          .hero-layout { width: min(1180px, calc(100% - 80px)); gap: clamp(28px, 4vw, 74px); }
          .hero h1 { font-size: clamp(40px, min(4.7vw, 7.2vh), 70px); margin: clamp(12px,2vh,23px) 0; }
          .hero .intro { line-height: 1.65; }
          .hero-actions { margin: clamp(17px,2.5vh,29px) 0 clamp(13px,2vh,23px); }
          .scroll-cue { margin-top: clamp(12px,2.4vh,26px); }
          .showcase { min-height: 0; padding: clamp(17px,2.5vh,26px); }
          .showcase-top { margin-bottom: clamp(10px,1.8vh,19px); }
          .showcase .demo { padding: clamp(15px,2.5vh,25px); }
          .showcase .demo h3 { margin-bottom: 12px; }
          .showcase .search-line { margin-bottom: 9px; }
          .showcase .demo-row { padding: clamp(9px,1.6vh,14px) 0; }
          .showcase .demo-note { margin-top: 12px; }
        }
        @media (min-width:721px) and (max-height:650px) {
          .hero { min-height: calc(100svh - 84px); }
          .hero-foot, .scroll-cue { display: none; }
          .showcase .demo-row { padding: 7px 0; }
          .hero .intro { font-size:14px; }
        }
        /* A calmer, more complete footer with subtle interaction. */
        .site-footer { background: var(--olive); color: #FFFFFF; padding: 74px 0 0; overflow: hidden; }
        .footer-main { display:grid; grid-template-columns:1.7fr .8fr .9fr 1.25fr; gap: clamp(26px, 3.8vw, 60px); padding-bottom:66px; }
        .site-footer .logo { color:var(--paper); font-size:23px; }
        .site-footer .logo-icon { background:var(--paper); color:var(--olive); width:34px; height:34px; }
        .footer-brand p { max-width:285px; font-size:13px; line-height:1.85; color:#D1E0EB; margin:20px 0; }
        .footer-cta { display:inline-flex; align-items:center; gap:10px; color:var(--paper); border-bottom:1px solid #B9AB97; padding-bottom:7px; font-size:12px; font-weight:700; }
        .footer-cta span { transition:transform .3s ease; }
        .footer-cta:hover span { transform:translate(4px,-4px); }
        .footer-links, .footer-note { display:flex; flex-direction:column; align-items:start; gap:14px; }
        .site-footer h3 { text-transform:uppercase; letter-spacing:.13em; color:#B5AB9B; font-size:10px; font-weight:800; margin:5px 0 9px; }
        .footer-links a { font-size:13px; color:#EDF4FA; transition:color .25s, transform .3s; }
        .footer-links a:hover { color:#C8DFEE; transform:translateX(4px); }
        .footer-note p { color:#D1E0EB; font-size:12px; line-height:1.85; max-width:285px; margin:0; }
        .footer-bottom { border-top:1px solid rgba(247,245,240,.20); padding:23px 0; display:flex; justify-content:space-between; gap:20px; align-items:center; color:#BED4E6; font-size:11px; }
        .footer-bottom a { color:var(--paper); transition:transform .3s; }
        .footer-bottom a:hover { transform:translateY(-3px); }
        /* More tactile but lightweight motion. */
        .site-footer .logo-icon { transition:transform .6s cubic-bezier(.16,1,.3,1); }
        .site-footer .logo:hover .logo-icon { transform:rotate(-13deg) scale(1.08); }
        #features .feature { transition: background .35s ease, transform .5s cubic-bezier(.16,1,.3,1); }
        #features .feature:hover { transform:translateY(-7px); }
        .demo-row svg { transition:transform .4s cubic-bezier(.16,1,.3,1); }
        .demo-row:hover svg { transform:translateX(7px); }
        .intro-strip .text-link { transition:letter-spacing .3s, color .3s; }
        .intro-strip .text-link:hover { letter-spacing:.025em; }
        @media (max-width:960px) { .footer-main { grid-template-columns:1.4fr 1fr; row-gap:38px; } }
        @media (max-width:720px) {
          .hero { min-height:auto; }
          .site-footer { padding-top:55px; }
          .footer-main { grid-template-columns:1fr 1fr; gap:38px 20px; padding-bottom:42px; }
          .footer-brand, .footer-note { grid-column:1 / -1; }
          .footer-bottom { align-items:flex-start; flex-direction:column; }
        }
        @media (prefers-reduced-motion:reduce) { #features .feature:hover, .footer-cta:hover span, .footer-links a:hover { transform:none; } }

        /* Fix contrast on the dark second section, including hover. */
        #features .section-head h2, #features .feature h3 { color: #F5F8FC !important; }
        #features .feature:hover h3 { color: #E6F0F7 !important; }
        #features .feature p { color: #DDE9F2 !important; }
        #features .feature-no, #features .topline { color: #D6E7F3 !important; }
        #features .feature svg { color: #D4E5F1 !important; }
        /* Hero function carousel */
        .feature-carousel { overflow:hidden; padding: 25px 25px 17px; }
        .carousel-viewport { position:relative; height: 318px; overflow:hidden; }
        .carousel-slide { position:absolute; inset:0; opacity:0; visibility:hidden; pointer-events:none; transform:translateX(32px) scale(.975); filter:blur(5px); transition:opacity .6s ease, transform .65s cubic-bezier(.2,.8,.2,1), filter .6s ease, visibility .6s; }
        .carousel-slide.is-current { opacity:1; visibility:visible; pointer-events:auto; transform:translateX(0) scale(1); filter:blur(0); z-index:1; }
        .carousel-slide.is-before { transform:translateX(-32px) scale(.975); }
        .carousel-slide h3 { color:var(--brown); font-size:clamp(19px,2vw,23px); line-height:1.25; margin: 0 0 9px; }
        .slide-description { color:#5B7185; font-size:12px; line-height:1.65; min-height:40px; margin:0 0 16px; }
        .carousel-visual { background:#EFF5FA; border:1px solid #D2E2EE; border-radius:5px; min-height:172px; padding:14px; overflow:hidden; }
        .fake-search { background:white; border:1px solid #D2E2EE; border-radius:4px; padding:10px; display:flex; align-items:center; gap:9px; font-size:11px; color:#786D62; margin-bottom:10px; }
        .fake-search svg { width:16px; height:16px; flex:none; }
        .typing-copy { overflow:hidden; white-space:nowrap; max-width:0; }
        .is-current .typing-copy { animation:typing 2.5s steps(22,end) .3s both; }
        .fake-cursor { width:1px; height:12px; background:var(--brown); animation:blink .8s steps(1) infinite; }
        @keyframes typing { to { max-width:180px; } } @keyframes blink { 50% { opacity:0; } }
        .visual-item { display:flex; gap:9px; align-items:center; padding:8px 5px; border-top:1px solid #D9E6EF; font-size:11px; font-weight:600; color:var(--brown); }
        .visual-dot { width:7px; height:7px; background:var(--sage); border-radius:50%; }
        .visual-arrow { margin-left:auto; font-size:16px; color:var(--clay); }
        .match-top { display:flex; align-items:center; gap:12px; margin-bottom:10px; } .mini-circle { background:#DFEAF2; color:var(--brown); border-radius:50%; width:31px; height:31px; display:grid; place-items:center; font-weight:800; }
        .match-top strong, .reminder-visual strong { display:block; font-size:12px; } .match-top small { font-size:10px; color:var(--muted); }
        .match-line { display:flex; justify-content:space-between; border-top:1px solid #C8D8E5; padding:9px 0; font-size:11px; color:#61594F; } .match-line strong { color:var(--brown); }
        .match-tag { display:inline-flex; background:#DCEAF3; color:#38251F; padding:5px 9px; border-radius:3px; font-size:10px; font-weight:700; }
        .checklist-header { display:flex; justify-content:space-between; font-weight:700; font-size:12px; } .checklist-header span { color:var(--sage); font-size:10px; }
        .progress-track { height:5px; background:#D7E4EE; border-radius:8px; margin:12px 0; overflow:hidden; } .progress-track span { display:block; background:var(--sage); height:100%; width:0; transition:width .8s ease; } .is-current .progress-track span { width:66.66%; }
        .check-item { display:flex; align-items:center; gap:9px; font-size:11px; padding:7px 0; color:var(--brown); }
        .check-box { border:1px solid #A99C8B; width:16px; height:16px; display:grid; place-items:center; border-radius:3px; font-size:10px; } .check-box.is-done { color:white; background:var(--olive); border-color:var(--olive); }
        .reminder-visual { display:grid; grid-template-columns:44px 1fr; gap:12px; align-content:center; } .reminder-bell { background:var(--olive); color:white; width:40px; height:40px; display:grid; place-items:center; border-radius:50%; } .reminder-bell svg { width:21px; height:21px; } .is-current .reminder-bell { animation:ringbell 1.2s ease .3s; } @keyframes ringbell { 20%,60% { transform:rotate(14deg); } 40%,80% { transform:rotate(-12deg); } }
        .reminder-visual p { margin:5px 0; color:var(--muted); font-size:11px; } .reminder-bottom { grid-column:1/-1; border-top:1px solid #C8D8E5; padding-top:16px; color:var(--brown); font-size:11px; } .reminder-pulse { display:inline-block; width:7px; height:7px; border-radius:50%; background:#91AEC7; margin-right:5px; animation:pulse 2s infinite; } @keyframes pulse { 50% { box-shadow:0 0 0 6px #91AEC722; } }
        .carousel-bottom { display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--line); padding-top:11px; }
        .carousel-dots, .carousel-arrows { display:flex; align-items:center; gap:7px; }
        .carousel-dot { width:8px; height:8px; border:0; border-radius:50%; background:#B9CFDF; padding:0; transition:width .35s ease, background .35s ease; } .carousel-dot.is-active { width:24px; border-radius:10px; background:var(--clay); }
        .carousel-arrow { border:1px solid #B9CFDF; background:transparent; border-radius:50%; width:30px; height:30px; color:var(--brown); transition:background .25s, color .25s, transform .25s; } .carousel-arrow:hover { background:var(--brown); color:white; transform:scale(1.08); }
        .carousel-arrow:focus-visible, .carousel-dot:focus-visible { outline:2px solid var(--clay); outline-offset:4px; }
        @media(max-width:450px) { .feature-carousel { padding:18px 16px 14px; } .carousel-viewport { height:340px; } .carousel-slide h3 { font-size:19px; } .slide-description { min-height:58px; } }
        @media(prefers-reduced-motion:reduce) { .carousel-slide { transition:none; transform:none; filter:none; } .is-current .typing-copy { animation:none; max-width:180px; } .fake-cursor,.reminder-pulse,.is-current .reminder-bell { animation:none; } }


        /* ScholarHunt page transition: panel and wordmark move together. */
        .page-wipe {
            --wipe-from: 100%;
            --wipe-to: -100%;
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: grid;
            place-items: center;
            background: #223B57;
            color: #F5F8FC;
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
            color: #F5F8FC;
            /* No independent text transform, animation, or transition. */
        }
        .page-wipe-wordmark .dot { color: #D2E2EE; }
        @media (prefers-reduced-motion: reduce) { .page-wipe { display: none !important; } }
    </style>
</head>
<body>
    <div class="page-wipe" id="page-wipe" aria-hidden="true"><span class="page-wipe-wordmark">ScholarHunt<span class="dot">.</span></span></div>
    <button class="back-to-top" type="button" id="back-to-top" aria-label="Back to top"><svg viewBox="0 0 24 24"><path d="M12 19V5m-7 7 7-7 7 7"/></svg></button>
    <div class="scroll-progress" id="scroll-progress" aria-hidden="true"></div>
    @php
        // Update these paths once the matching pages/routes are ready.
        $registerUrl = url('/register');
        $loginUrl = url('/login');
    @endphp
    <header class="nav-shell">
        <nav class="wrap nav" aria-label="Main navigation">
            <a class="logo" href="#top" aria-label="ScholarHunt home">
                <span class="logo-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5M21 9v6"/></svg></span>
                ScholarHunt
            </a>
            <div class="nav-mid" id="nav-links">
                <a href="#about">About</a>
                <a href="#features">What you'll find</a>
                <a href="#how">How it works</a>
            </div>
            <div class="nav-end">
                <a class="sign-in" href="{{ $loginUrl }}">Log in</a>
                <a class="btn btn-dark" href="{{ $registerUrl }}">Get started <span aria-hidden="true">↗</span></a>
                <button class="menu-btn" id="menu-btn" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="nav-links"><svg viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></svg></button>
            </div>
        </nav>
    </header>

    <main id="top">
        <section class="hero" id="about">
            <div class="wrap hero-layout">
                <div class="reveal">
                    <span class="topline">For students looking ahead</span>
                    <h1>Good opportunities shouldn't be <em>hard to find.</em></h1>
                    <p class="intro">Scholarships get posted in different places. ScholarHunt helps you find them in one place, check which ones might fit you, and keep track of the ones you want to apply for.</p>
                    <div class="hero-actions">
                        <a href="{{ $registerUrl }}" class="btn btn-dark">Start finding scholarships <svg viewBox="0 0 24 24"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                        <a href="#how" class="btn btn-outline">How it works</a>
                    </div>
                    <div class="hero-foot"><svg viewBox="0 0 24 24"><path d="M12 3 4 7v5c0 5 3 8 8 9 5-1 8-4 8-9V7l-8-4Z"/><path d="m9 12 2 2 4-4"/></svg> Open to students across different year levels</div>
                    <a class="scroll-cue" href="#features">Scroll to explore <svg viewBox="0 0 24 24"><path d="M12 4v16m-6-6 6 6 6-6"/></svg></a>
                </div>
                <div class="showcase reveal" aria-label="ScholarHunt feature previews">
                    <div class="showcase-top"><span><i class="eyebrow-dot"></i>SCHOLARHUNT / PREVIEW</span><span id="slide-counter">01 — 04</span></div>
                    <div class="demo feature-carousel" id="feature-carousel" aria-roledescription="carousel" aria-label="ScholarHunt functions">
                        <div class="carousel-viewport" aria-live="off">
                            <div class="carousel-slide is-current" data-slide="0" aria-hidden="false">
                                <span class="demo-label">01 / Discover opportunities</span>
                                <h3>Find scholarships in one place.</h3>
                                <p class="slide-description">Explore scholarship announcements gathered from online sources.</p>
                                <div class="carousel-visual">
                                    <div class="fake-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m16 16 5 5"/></svg><span class="typing-copy">Search scholarships...</span><span class="fake-cursor"></span></div>
                                    <div class="visual-item"><span class="visual-dot"></span><span>Academic scholarships</span><span class="visual-arrow">↗</span></div>
                                    <div class="visual-item"><span class="visual-dot"></span><span>Grants & financial aid</span><span class="visual-arrow">↗</span></div>
                                </div>
                            </div>
                            <div class="carousel-slide" data-slide="1" aria-hidden="true">
                                <span class="demo-label">02 / Relevant matches</span>
                                <h3>See what could fit your profile.</h3>
                                <p class="slide-description">Basic student details help narrow your search. Always confirm eligibility with the provider.</p>
                                <div class="carousel-visual match-visual"><div class="match-top"><span class="mini-circle">✓</span><div><strong>Personalized discovery</strong><small>Based on your student profile</small></div></div><div class="match-line"><span>Education level</span><strong>College</strong></div><div class="match-line"><span>Location</span><strong>Your region</strong></div><div class="match-tag">Potentially relevant matches ↗</div></div>
                            </div>
                            <div class="carousel-slide" data-slide="2" aria-hidden="true">
                                <span class="demo-label">03 / Application organizer</span>
                                <h3>Keep your requirements in check.</h3>
                                <p class="slide-description">Save the scholarships you plan to apply for and organize what you still need.</p>
                                <div class="carousel-visual checklist-visual"><div class="checklist-header">My requirements <span>2 of 3 prepared</span></div><div class="progress-track"><span></span></div><div class="check-item"><span class="check-box is-done">✓</span>Enrollment certificate</div><div class="check-item"><span class="check-box is-done">✓</span>School ID</div><div class="check-item"><span class="check-box"></span>Personal statement</div></div>
                            </div>
                            <div class="carousel-slide" data-slide="3" aria-hidden="true">
                                <span class="demo-label">04 / Deadline reminders</span>
                                <h3>Stay aware of important dates.</h3>
                                <p class="slide-description">Track application status and get reminders when saved deadlines are approaching.</p>
                                <div class="carousel-visual reminder-visual"><div class="reminder-bell"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/></svg></div><div><strong>Upcoming deadline</strong><p>Example reminder · 3 days remaining</p></div><div class="reminder-bottom"><span class="reminder-pulse"></span> Organize your next steps ahead of time</div></div>
                            </div>
                        </div>
                        <div class="carousel-bottom"><div class="carousel-dots" role="group" aria-label="Choose feature"><button class="carousel-dot is-active" type="button" aria-label="Show scholarship search" aria-current="true"></button><button class="carousel-dot" type="button" aria-label="Show profile matches"></button><button class="carousel-dot" type="button" aria-label="Show requirements checklist"></button><button class="carousel-dot" type="button" aria-label="Show deadline reminders"></button></div><div class="carousel-arrows"><button type="button" class="carousel-arrow" id="carousel-prev" aria-label="Previous feature">←</button><button type="button" class="carousel-arrow" id="carousel-next" aria-label="Next feature">→</button></div></div>
                    </div>
                    <p class="demo-note">Feature preview only. Listings and reminders shown here are illustrative.</p>
                </div>
            </div>
        </section>
        <div class="rule"><div class="wrap intro-strip reveal"><p><strong>Less time scrolling through posts.</strong> More time preparing for opportunities that matter.</p><a class="text-link" href="#features">See what ScholarHunt does ↗</a></div></div>

        <section class="content" id="features">
            <div class="wrap">
                <div class="section-head reveal">
                    <div><span class="topline">One place to keep up</span><h2>From finding it<br>to applying for it.</h2></div>
                    <p>ScholarHunt is here to make scholarship searching less scattered. Find announcements, save what matters, and stay organized while you prepare your applications.</p>
                </div>
                <div class="features">
                    <article class="feature reveal" data-delay="0"><span class="feature-no">01 / DISCOVER</span><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m16 16 5 5"/></svg><h3>Find scholarship posts</h3><p>Browse opportunities collected from online announcements, then follow the original link to learn more.</p></article>
                    <article class="feature reveal" data-delay="1"><span class="feature-no">02 / FILTER</span><svg viewBox="0 0 24 24"><path d="M4 6h16M7 12h10m-7 6h4"/><circle cx="9" cy="6" r="2"/><circle cx="16" cy="12" r="2"/></svg><h3>See what might fit</h3><p>Use basic information from your profile to narrow down scholarships that may be relevant to you.</p></article>
                    <article class="feature reveal" data-delay="2"><span class="feature-no">03 / ORGANIZE</span><svg viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="m8 10 2 2 4-4M8 17h8"/></svg><h3>Keep your own checklist</h3><p>Track scholarships you're interested in or have applied for, and check off requirements as you prepare them.</p></article>
                    <article class="feature reveal" data-delay="3"><span class="feature-no">04 / REMEMBER</span><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/></svg><h3>Know what's due</h3><p>Get reminders when a scholarship deadline you're following is getting close.</p></article>
                </div>
            </div>
        </section>

        <section class="process" id="how">
            <div class="wrap">
                <div class="process-head reveal"><span class="topline">How it works</span><h2>Start with a search.<br>Take it from there.</h2></div>
                <div class="steps">
                    <div class="step reveal" data-delay="0"><span class="step-num">01 — TELL US THE BASICS</span><h3>Create your profile</h3><p>Add details like your student level and other general information to help narrow your search.</p></div>
                    <div class="step reveal" data-delay="1"><span class="step-num">02 — LOOK AROUND</span><h3>Explore opportunities</h3><p>Browse scholarship announcements and open the original source to review eligibility and application details.</p></div>
                    <div class="step reveal" data-delay="2"><span class="step-num">03 — STAY ON TOP OF IT</span><h3>Save and track</h3><p>Keep your application list, requirements, and upcoming deadlines together so nothing gets lost.</p></div>
                </div>
            </div>
        </section>

        <section class="last">
            <div class="wrap last-inner reveal">
                <div><h2>Your next opportunity could be out there.</h2><p>ScholarHunt helps you discover and organize scholarship information. Applications are completed through the scholarship provider's own page or form. Always check the official requirements before applying.</p></div>
                <a class="btn btn-cream" href="{{ $registerUrl }}">Get started <svg viewBox="0 0 24 24"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            </div>
        </section>
    </main>

    <footer id="footer" class="site-footer">
        <div class="wrap">
            <div class="footer-main">
                <div class="footer-brand reveal">
                    <a class="logo" href="#top"><span class="logo-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/></svg></span>ScholarHunt</a>
                    <p>A simpler way to find scholarship announcements and keep your applications organized.</p>
                    <a href="{{ $registerUrl }}" class="footer-cta">Start exploring <span aria-hidden="true">↗</span></a>
                </div>
                <div class="footer-links reveal" data-delay="1">
                    <h3>Explore</h3>
                    <a href="#about">Home</a>
                    <a href="#features">What you'll find</a>
                    <a href="#how">How it works</a>
                </div>
                <div class="footer-links reveal" data-delay="2">
                    <h3>Your account</h3>
                    <a href="{{ $loginUrl }}">Log in</a>
                    <a href="{{ $registerUrl }}">Create an account</a>
                </div>
                <div class="footer-note reveal" data-delay="3">
                    <h3>Good to know</h3>
                    <p>ScholarHunt helps you discover opportunities. Scholarship providers handle the applications. Always verify the details with the original source.</p>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© {{ date('Y') }} ScholarHunt. Made for students.</span>
                <a href="#top">Back to top ↑</a>
            </div>
        </div>
    </footer>
    <script>
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const progressBar = document.getElementById('scroll-progress');
        const navbar = document.querySelector('.nav-shell');
        let scrolling = false;
        function updateScrollUI() {
            const scrollable = document.documentElement.scrollHeight - window.innerHeight;
            progressBar.style.transform = `scaleX(${scrollable > 0 ? window.scrollY / scrollable : 0})`;
            navbar.classList.toggle('scrolled', window.scrollY > 12);
            document.getElementById('back-to-top').classList.toggle('show', window.scrollY > 500);
            scrolling = false;
        }
        window.addEventListener('scroll', () => {
            if (!scrolling) { window.requestAnimationFrame(updateScrollUI); scrolling = true; }
        }, { passive: true });
        window.addEventListener('resize', updateScrollUI, { passive: true });
        updateScrollUI();
        if (!prefersReducedMotion && 'IntersectionObserver' in window) {
            document.body.classList.add('js-motion');
            const observer = new IntersectionObserver(entries => {
                for (const entry of entries) {
                    entry.target.classList.toggle('is-visible', entry.isIntersecting);
                }
            }, { threshold: .06, rootMargin: '-5% 0px -5% 0px' });
            document.querySelectorAll('.reveal').forEach(element => observer.observe(element));
        }
        // Automatically rotating, manually controllable feature carousel.
        const carousel = document.getElementById('feature-carousel');
        const slides = [...carousel.querySelectorAll('.carousel-slide')];
        const dots = [...carousel.querySelectorAll('.carousel-dot')];
        const counter = document.getElementById('slide-counter');
        let activeSlide = 0;
        let carouselTimer;
        const showSlide = (next) => {
            const previous = activeSlide;
            activeSlide = (next + slides.length) % slides.length;
            slides.forEach((slide, index) => {
                slide.classList.toggle('is-current', index === activeSlide);
                slide.classList.toggle('is-before', index === previous && index !== activeSlide);
                slide.setAttribute('aria-hidden', String(index !== activeSlide));
            });
            dots.forEach((dot, index) => {
                const current = index === activeSlide;
                dot.classList.toggle('is-active', current);
                if (current) dot.setAttribute('aria-current', 'true');
                else dot.removeAttribute('aria-current');
            });
            counter.textContent = `${String(activeSlide + 1).padStart(2,'0')} — 04`;
        };
        const stopCarousel = () => window.clearInterval(carouselTimer);
        const startCarousel = () => {
            stopCarousel();
            if (!prefersReducedMotion && !document.hidden) carouselTimer = window.setInterval(() => showSlide(activeSlide + 1), 4500);
        };
        dots.forEach((dot, index) => dot.addEventListener('click', () => { showSlide(index); startCarousel(); }));
        document.getElementById('carousel-prev').addEventListener('click', () => { showSlide(activeSlide - 1); startCarousel(); });
        document.getElementById('carousel-next').addEventListener('click', () => { showSlide(activeSlide + 1); startCarousel(); });
        carousel.addEventListener('mouseenter', stopCarousel);
        carousel.addEventListener('mouseleave', startCarousel);
        carousel.addEventListener('focusin', stopCarousel);
        carousel.addEventListener('focusout', event => { if (!carousel.contains(event.relatedTarget)) startCarousel(); });
        document.addEventListener('visibilitychange', () => document.hidden ? stopCarousel() : startCarousel());
        startCarousel();
        document.getElementById('back-to-top').addEventListener('click', () => window.scrollTo({top:0,behavior:prefersReducedMotion?'instant':'smooth'}));
        // Active section states make it easier to know where you are.
        if ('IntersectionObserver' in window) {
            const navLinks = [...document.querySelectorAll('.nav-mid a[href^="#"]')];
            const sections = navLinks.map(link => document.querySelector(link.getAttribute('href'))).filter(Boolean);
            const sectionWatcher = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) navLinks.forEach(link => link.classList.toggle('active', link.getAttribute('href') === `#${entry.target.id}`));
                });
            }, { rootMargin:'-18% 0px -68% 0px' });
            sections.forEach(section => sectionWatcher.observe(section));
        }
        // Spotlight responds to pointer position, but isn't needed on touch devices.
        const showcase = document.querySelector('.showcase');
        if (!prefersReducedMotion && window.matchMedia('(hover:hover) and (pointer:fine)').matches) {
            showcase.addEventListener('pointermove', event => {
                const rect = showcase.getBoundingClientRect();
                showcase.style.setProperty('--mx', `${event.clientX - rect.left}px`);
                showcase.style.setProperty('--my', `${event.clientY - rect.top}px`);
            });
        }
        // Landing -> Login: up / up. Login -> Landing: down / down.
        // Only the panel moves: the wordmark remains centered inside it.
        if (!prefersReducedMotion) {
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
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('nav-links');
        menuBtn.addEventListener('click', () => {
            const open = menu.classList.toggle('open');
            menuBtn.setAttribute('aria-expanded', String(open));
        });
        menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
            menu.classList.remove('open');
            menuBtn.setAttribute('aria-expanded', 'false');
        }));
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                menu.classList.remove('open');
                menuBtn.setAttribute('aria-expanded', 'false');
            }
        });
        document.addEventListener('click', event => {
            if (!menu.contains(event.target) && !menuBtn.contains(event.target)) {
                menu.classList.remove('open');
                menuBtn.setAttribute('aria-expanded', 'false');
            }
        });
    </script>
</body>
</html>
