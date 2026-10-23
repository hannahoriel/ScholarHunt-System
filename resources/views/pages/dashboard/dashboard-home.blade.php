@extends('pages.dashboard.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    .dashboard-home{display:grid;gap:26px}
    .welcome-hero{position:relative;isolation:isolate;overflow:hidden;display:grid;grid-template-columns:minmax(0,1.35fr) minmax(210px,.65fr);align-items:center;gap:24px;min-height:310px;padding:clamp(28px,4vw,46px);border-radius:24px;background:linear-gradient(118deg,#131A28 0%,#18364A 56%,#1F6A8F 100%);color:#F5FAFD;box-shadow:0 18px 42px #131A2826}
    .welcome-hero:before,.welcome-hero:after{content:"";position:absolute;z-index:-1;border:1px solid #FFFFFF16;border-radius:50%;pointer-events:none}
    .welcome-hero:before{width:420px;height:420px;right:-120px;top:-240px}
    .welcome-hero:after{width:300px;height:300px;right:-35px;bottom:-230px}
    .welcome-copy{max-width:640px}
    .eyebrow{display:inline-flex;align-items:center;gap:9px;color:#BBDCEB;font-size:10px;font-weight:800;letter-spacing:.16em;margin-bottom:17px}
    .eyebrow-dot{width:7px;height:7px;border-radius:50%;background:#7FD4C1;box-shadow:0 0 0 4px #7FD4C120}
    .welcome-hero h1{font-size:clamp(30px,4vw,47px);font-weight:800;letter-spacing:-.065em;line-height:1.08;color:#fff;max-width:560px}
    .welcome-hero h1 span{color:#8BD5D0}
    .welcome-copy>p{max-width:540px;color:#D0E0E9;font-size:14px;line-height:1.8;margin-top:15px}
    .hero-actions{display:flex;gap:11px;flex-wrap:wrap;margin-top:25px}
    .hero-btn{display:inline-flex;align-items:center;justify-content:center;gap:9px;min-height:46px;padding:0 18px;border-radius:9px;font-size:13px;font-weight:800;transition:transform .2s,background .2s}
    .hero-btn:hover{transform:translateY(-2px)}
    .hero-btn-primary{background:#F5FAFD;color:#142637}
    .hero-btn-primary:hover{background:#DDF2EF}
    .hero-btn-secondary{border:1px solid #FFFFFF38;color:#F5FAFD;background:#FFFFFF0D}
    .hero-btn svg{width:17px;height:17px}
    .hero-art{position:relative;min-height:230px;display:grid;place-items:center}
    .art-glow{position:absolute;width:190px;height:190px;border-radius:50%;background:#55B9B555;filter:blur(35px)}
    .art-orbit{position:absolute;border:1px solid #FFFFFF20;border-radius:50%;transform:rotate(-25deg)}
    .orbit-one{width:245px;height:165px}.orbit-two{width:185px;height:245px;transform:rotate(35deg)}
    .art-card{position:absolute;width:188px;border:1px solid #FFFFFF50;border-radius:15px;box-shadow:0 18px 35px #06101D45}
    .art-card-back{height:135px;right:4%;top:28px;padding:18px;background:#DCECF0;transform:rotate(10deg);opacity:.84}
    .art-mini-line{display:block;width:80%;height:6px;border-radius:5px;background:#A8C5D1;margin-bottom:9px}
    .art-mini-line.short{width:55%}.art-mini-pill{display:block;width:62px;height:18px;border-radius:20px;background:#B8DCD7;margin-top:20px}
    .art-card-front{z-index:2;left:8%;top:47px;padding:18px 18px 15px;background:linear-gradient(145deg,#FFFFFF 0%,#EAF5F6 100%);color:var(--navy);transform:rotate(-5deg)}
    .art-cap{width:35px;height:35px;display:grid;place-items:center;border-radius:10px;background:#D8EEEA;color:#1F6A8F;margin-bottom:15px}
    .art-cap svg{width:21px;height:21px}
    .art-label{display:block;font-size:8px;letter-spacing:.12em;font-weight:800;color:#52788A;margin-bottom:6px}
    .art-card-front strong{font:800 19px/1.15 'Manrope',sans-serif;letter-spacing:-.05em}
    .art-progress{display:block;height:5px;border-radius:10px;background:#D7E5E9;margin-top:17px;overflow:hidden}
    .art-progress i{display:block;width:68%;height:100%;border-radius:10px;background:#39A99D}
    .art-card-front small{display:block;color:#648092;font-size:9px;margin-top:7px}
    .home-section-head{display:flex;align-items:end;justify-content:space-between;gap:16px}
    .home-kicker{font-size:10px;font-weight:800;letter-spacing:.15em;color:var(--teal)}
    .home-section-head h2{font-size:clamp(22px,2.5vw,28px);line-height:1.2;letter-spacing:-.055em;margin-top:5px}
    .home-section-head p{font-size:13px;color:var(--muted);margin-top:6px}
    .quick-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:15px}
    .quick-card{display:flex;flex-direction:column;align-items:flex-start;gap:12px;padding:22px;background:#fff;border:1px solid var(--line);border-radius:16px;box-shadow:var(--shadow-sm);transition:transform .2s,border-color .2s,box-shadow .2s}
    .quick-card:hover{transform:translateY(-3px);border-color:#A8C8D8;box-shadow:var(--shadow-md)}
    .quick-icon{width:45px;height:45px;display:grid;place-items:center;border-radius:13px;background:#E5F1F7;color:var(--teal)}
    .quick-icon svg{width:22px;height:22px}
    .quick-card h3{font-size:16px;letter-spacing:-.035em}
    .quick-card p{font-size:13px;color:var(--muted);line-height:1.7}
    .quick-link{display:inline-flex;align-items:center;gap:7px;margin-top:auto;padding-top:3px;color:var(--teal);font-size:12.5px;font-weight:800}
    .quick-link svg{width:15px;height:15px}
    .home-tip{display:flex;align-items:flex-start;gap:14px;padding:19px 21px;background:#E9F4F7;border:1px solid #D1E5EC;border-radius:15px}
    .tip-icon{width:38px;height:38px;display:grid;place-items:center;flex:none;background:#D2E9EC;border-radius:11px;color:var(--teal)}
    .tip-icon svg{width:19px;height:19px}
    .home-tip strong{display:block;font-size:13px;margin-bottom:3px}
    .home-tip p{font-size:12.5px;color:#526F80;line-height:1.7}
    @media(max-width:760px){.welcome-hero{grid-template-columns:1fr;min-height:0}.hero-art{min-height:200px;max-width:330px;width:100%;margin:0 auto}.quick-grid{grid-template-columns:1fr}.quick-card{padding:19px}.home-section-head{align-items:flex-start;flex-direction:column}}
    @media(prefers-reduced-motion:reduce){.hero-btn,.quick-card{transition:none}}
</style>
@endpush

@section('content')
@php
    $firstName = auth()->check() ? trim(auth()->user()->first_name ?? '') : '';
    $greetingName = $firstName !== '' ? $firstName : 'there';
@endphp

<div class="dashboard-home">
    <section class="welcome-hero" aria-labelledby="welcome-title">
        <div class="welcome-copy">
            <span class="eyebrow"><span class="eyebrow-dot"></span> YOUR SCHOLARHUNT DASHBOARD</span>
            <h1 id="welcome-title">Welcome back, {{ $greetingName }}. <span>Your future starts here.</span></h1>
            <p>Find opportunities that support your education goals. Explore scholarships, check application deadlines, and save promising options as you plan your next step.</p>
            <div class="hero-actions">
                <a class="hero-btn hero-btn-primary" href="{{ route('dashboard.discover') }}">Discover scholarships
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <a class="hero-btn hero-btn-secondary" href="{{ route('dashboard.discover') }}#scholarship-search">Search opportunities</a>
            </div>
        </div>
        <div class="hero-art" aria-hidden="true">
            <div class="art-orbit orbit-one"></div><div class="art-orbit orbit-two"></div><div class="art-glow"></div>
            <div class="art-card art-card-back"><span class="art-mini-line"></span><span class="art-mini-line short"></span><span class="art-mini-pill"></span></div>
            <div class="art-card art-card-front">
                <span class="art-cap"><svg viewBox="0 0 24 24"><path d="m2 9 10-5 10 5-10 5L2 9Z"/><path d="M6 11v5c4 3 8 3 12 0v-5M22 9v6"/></svg></span>
                <span class="art-label">YOUR NEXT CHAPTER</span><strong>Dream big.<br>Study forward.</strong>
                <span class="art-progress"><i></i></span><small>Opportunity awaits</small>
            </div>
        </div>
    </section>

    <section class="home-section-head" aria-labelledby="explore-title">
        <div><span class="home-kicker">START EXPLORING</span><h2 id="explore-title">Make your next move</h2><p>Choose where you want to begin. You can always come back to this dashboard.</p></div>
    </section>

    <section class="quick-grid" aria-label="ScholarHunt actions">
        <a class="quick-card" href="{{ route('dashboard.discover') }}">
            <span class="quick-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m16 16 5 5"/></svg></span>
            <h3>Discover scholarships</h3>
            <p>Browse scholarship opportunities, compare eligibility, and check application deadlines.</p>
            <span class="quick-link">Explore listings <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
        </a>
        <a class="quick-card" href="{{ route('dashboard.tracker') }}">
            <span class="quick-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 9h8M8 13h5M8 17h3"/></svg></span>
            <h3>Application tracker</h3>
            <p>Keep an eye on scholarships you are preparing for and the next steps you need to take.</p>
            <span class="quick-link">Open tracker <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
        </a>
        <a class="quick-card" href="{{ route('dashboard.reviewer') }}">
            <span class="quick-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5.5C5.5 4 9 4 12 6c3-2 6.5-2 9-.5V19c-2.5-1.5-6-1.5-9 .5-3-2-6.5-2-9-.5V5.5Z"/><path d="M12 6v13.5"/></svg></span>
            <h3>Find reviewers</h3>
            <p>Explore study support and reviewers to help you prepare for your academic goals.</p>
            <span class="quick-link">Browse reviewers <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
        </a>
    </section>

    <aside class="home-tip">
        <span class="tip-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3a7 7 0 0 0-4 12.75c.8.55 1.25 1.25 1.4 2.25h5.2c.15-1 .6-1.7 1.4-2.25A7 7 0 0 0 12 3Z"/><path d="M9.5 21h5M10 18h4"/></svg></span>
        <div><strong>ScholarHunt tip</strong><p>Start early and check deadlines regularly. If a scholarship looks promising, open its details to review eligibility and requirements before applying.</p></div>
    </aside>
</div>
@endsection
