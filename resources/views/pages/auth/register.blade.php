<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#131A28">
    <title>Create an account — ScholarHunt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* =====================================================================
           DESIGN TOKENS  –  palette from brief
           #131A28  dark navy    (darkest)
           #1F6A8F  teal/primary (action)
           #7BA0C0  steel        (mid blue)
           #C4D6DE  mist         (lightest)
        ===================================================================== */
        :root{
            --navy:   #131A28;
            --teal:   #1F6A8F;
            --teal-dk:#185877;
            --teal-lt:#2480AC;
            --steel:  #7BA0C0;
            --mist:   #C4D6DE;
            --paper:  #F2F7FA;
            --card:   #FFFFFF;
            --line:   #D3E0E8;
            --muted:  #5C748A;
            --error:  #C0392B;
            --success:#1A7A4E;
            --shadow-sm: 0 1px 3px #131A2812, 0 1px 2px #131A280A;
            --shadow-md: 0 4px 16px #131A281A, 0 1px 4px #131A280D;
            --shadow-lg: 0 12px 40px #1F6A8F22, 0 4px 12px #131A2812;
            --radius: 10px;
            --radius-sm: 6px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            background: var(--paper);
            color: var(--navy);
            -webkit-font-smoothing: antialiased;
            line-height: 1.6;
        }
        a { color: inherit; text-decoration: none; }
        button, input, select { font: inherit; }
        button { cursor: pointer; }
        h1, h2, h3, .wordmark { font-family: 'Manrope', sans-serif; }
        :focus-visible { outline: 2px solid var(--teal); outline-offset: 3px; border-radius: 3px; }

        /* ============================================================
           LAYOUT SHELL
        ============================================================ */
        .auth-shell {
            display: grid;
            grid-template-columns: 420px 1fr;
            min-height: 100svh;
        }

        /* ============================================================
           BRAND SIDE
        ============================================================ */
        .brand-side {
            position: sticky;
            top: 0;
            height: 100svh;
            background: var(--navy);
            color: #E8F1F6;
            padding: 40px clamp(32px, 4vw, 56px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            isolation: isolate;
        }

        /* Decorative background layers */
        .brand-side .deco-ring {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }
        .brand-side .deco-ring::before {
            content: '';
            position: absolute;
            width: 520px; height: 520px;
            border-radius: 50%;
            border: 1px solid #7BA0C022;
            top: -160px; right: -180px;
        }
        .brand-side .deco-ring::after {
            content: '';
            position: absolute;
            width: 340px; height: 340px;
            border-radius: 50%;
            border: 1px solid #C4D6DE14;
            bottom: -100px; left: -120px;
        }
        .brand-glow {
            position: absolute;
            width: 480px; height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle at 40% 40%, #1F6A8F50 0%, transparent 65%);
            top: -80px; left: -100px;
            pointer-events: none;
            z-index: 0;
        }
        .brand-glow-2 {
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, #7BA0C018 0%, transparent 70%);
            bottom: 40px; right: -60px;
            pointer-events: none;
            z-index: 0;
        }

        /* Wordmark */
        .wordmark {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: -.07em;
            font-size: 22px;
            width: max-content;
            position: relative;
            z-index: 1;
            color: #E8F1F6;
        }
        .brand-mark {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: var(--teal);
            display: grid;
            place-items: center;
            box-shadow: 0 0 0 3px #1F6A8F40;
        }
        .brand-mark svg {
            width: 20px;
            fill: none;
            stroke: #fff;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Side content */
        .side-content {
            position: relative;
            z-index: 1;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 10.5px;
            letter-spacing: .16em;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--steel);
            margin-bottom: 20px;
        }
        .eyebrow::before {
            content: '';
            width: 22px; height: 1.5px;
            background: var(--teal);
            border-radius: 2px;
            flex-shrink: 0;
        }
        .side-content h2 {
            font-size: clamp(28px, 2.8vw, 42px);
            line-height: 1.17;
            letter-spacing: -.065em;
            font-weight: 800;
            margin-bottom: 18px;
            color: #F0F6FA;
        }
        .side-content p {
            font-size: 14px;
            line-height: 1.85;
            color: #96B5CA;
            max-width: 320px;
        }

        /* Perks list */
        .perks {
            list-style: none;
            margin-top: 36px;
            display: grid;
            gap: 16px;
        }
        .perks li {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 13.5px;
            color: #C2D6E4;
            font-weight: 500;
        }
        .perks .perk-icon {
            flex-shrink: 0;
            width: 32px; height: 32px;
            border-radius: 8px;
            background: #1F6A8F40;
            border: 1px solid #1F6A8F60;
            display: grid;
            place-items: center;
        }
        .perks .perk-icon svg {
            width: 14px; height: 14px;
            fill: none;
            stroke: var(--mist);
            stroke-width: 2.2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Divider line between perks */
        .side-divider {
            height: 1px;
            background: linear-gradient(90deg, #1F6A8F40, transparent);
            margin: 28px 0;
            position: relative;
            z-index: 1;
        }

        .side-footer {
            font-size: 12px;
            color: #4A6880;
            position: relative;
            z-index: 1;
            font-weight: 500;
            letter-spacing: .01em;
        }

        /* ============================================================
           MAIN FORM AREA
        ============================================================ */
        .auth-main {
            display: flex;
            flex-direction: column;
            padding: 36px clamp(24px, 5.5vw, 88px) 28px;
            min-width: 0;
            background: var(--paper);
        }

        .top-nav {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 16px;
            font-size: 12.5px;
            font-weight: 600;
            flex-shrink: 0;
        }
        .top-nav span {
            color: var(--muted);
            font-weight: 400;
        }
        .top-nav a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--teal);
            font-weight: 700;
            padding: 7px 14px;
            border: 1.5px solid #BFD0DA;
            border-radius: 100px;
            background: var(--card);
            transition: background .2s, border-color .2s, box-shadow .2s, transform .2s;
            box-shadow: var(--shadow-sm);
            font-size: 12px;
        }
        .top-nav a:hover {
            background: var(--teal);
            color: #fff;
            border-color: var(--teal);
            box-shadow: 0 4px 12px #1F6A8F30;
            transform: translateY(-1px);
        }
        .back-mobile { display: none; }

        /* ============================================================
           FORM WRAPPER
        ============================================================ */
        .form-layout {
            width: min(100%, 700px);
            margin: auto;
            padding: 44px 0 36px;
            animation: comeUp .7s cubic-bezier(.16, 1, .3, 1) both;
        }

        .welcome-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: .18em;
            font-size: 10px;
            font-weight: 800;
            color: var(--teal);
            margin-bottom: 14px;
        }
        .welcome-label::before {
            content: '';
            width: 18px; height: 2px;
            background: var(--teal);
            border-radius: 2px;
        }

        .form-layout h1 {
            font-size: clamp(30px, 3.8vw, 46px);
            font-weight: 800;
            letter-spacing: -.075em;
            line-height: 1.1;
            margin-bottom: 10px;
            color: var(--navy);
        }
        .subtitle {
            font-size: 14px;
            line-height: 1.75;
            color: var(--muted);
            margin-bottom: 32px;
        }

        /* ============================================================
           STEPPER
        ============================================================ */
        .stepper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            list-style: none;
            margin-bottom: 32px;
            padding: 20px;
            background: var(--card);
            border-radius: var(--radius);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-sm);
        }
        .stepper li {
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            color: var(--muted);
            padding: 0 4px;
        }
        .stepper .bar {
            height: 4px;
            border-radius: 4px;
            background: var(--line);
            overflow: hidden;
        }
        .stepper .bar-fill {
            height: 100%;
            border-radius: 4px;
            background: var(--line);
            transform: translateX(-101%);
            transition: transform .5s cubic-bezier(.16, 1, .3, 1), background .4s;
        }
        .stepper li.done .bar-fill,
        .stepper li.active .bar-fill {
            transform: translateX(0);
        }
        .stepper li.active .bar-fill { background: var(--teal); }
        .stepper li.done .bar-fill   { background: var(--steel); }
        .stepper li.active { color: var(--navy); }
        .stepper li.done   { color: var(--teal); }

        .stepper .step-meta {
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .stepper .num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px; height: 22px;
            border-radius: 50%;
            border: 1.5px solid currentColor;
            font-size: 10px;
            font-weight: 800;
            flex-shrink: 0;
            transition: background .3s, color .3s, border-color .3s;
        }
        .stepper li.active .num {
            background: var(--teal);
            color: #fff;
            border-color: var(--teal);
        }
        .stepper li.done .num {
            background: var(--steel);
            color: #fff;
            border-color: var(--steel);
        }

        /* ============================================================
           NOTICES
        ============================================================ */
        .form-notice {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            background: #E4F0F7;
            border: 1px solid #BCD6E4;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            font-size: 13px;
            line-height: 1.65;
            color: var(--navy);
        }
        .form-notice::before {
            content: 'ℹ';
            font-size: 14px;
            flex-shrink: 0;
            color: var(--teal);
            margin-top: 1px;
        }
        .form-notice.err {
            background: #FBEEED;
            border-color: #E8C2C0;
            color: #7A1E1A;
        }
        .form-notice.err::before { content: '!'; color: var(--error); font-weight: 700; }
        .form-notice ul { margin-top: 6px; padding-left: 18px; }

        /* ============================================================
           STEP FIELDSETS
        ============================================================ */
        .step {
            display: none;
            border: 0;
            padding: 0;
        }
        .step.active {
            display: block;
            animation: slideIn .4s cubic-bezier(.16, 1, .3, 1) both;
        }

        /* Step card wrapper */
        .step-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 28px 28px 24px;
            box-shadow: var(--shadow-md);
            margin-bottom: 4px;
        }
        .step-card-header {
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--line);
        }
        .step legend {
            font-family: 'Manrope', sans-serif;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.045em;
            color: var(--navy);
            padding: 0;
            margin-bottom: 5px;
        }
        .step .hint {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.65;
        }

        /* ============================================================
           GRID
        ============================================================ */
        .grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 18px 16px;
        }
        .c2 { grid-column: span 2; }
        .c3 { grid-column: span 3; }
        .c4 { grid-column: span 4; }
        .c6 { grid-column: span 6; }

        .section-title {
            grid-column: 1 / -1;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 12px 0 -4px;
            font-size: 10.5px;
            letter-spacing: .16em;
            text-transform: uppercase;
            font-weight: 800;
            color: var(--teal);
        }
        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        /* ============================================================
           FIELDS
        ============================================================ */
        .field { min-width: 0; }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 7px;
            letter-spacing: .01em;
        }
        .field label.level-card { display: flex; font-weight: 400; margin: 0; }
        .field label .opt {
            font-weight: 400;
            color: var(--muted);
            margin-left: 4px;
            font-size: 11px;
        }
        .field label .req {
            color: var(--teal);
            margin-left: 2px;
        }

        .field input,
        .field select {
            width: 100%;
            height: 48px;
            border: 1.5px solid #CCDDE7;
            background: var(--card);
            border-radius: var(--radius-sm);
            padding: 0 14px;
            color: var(--navy);
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s, transform .2s;
            appearance: none;
            -webkit-appearance: none;
            box-shadow: var(--shadow-sm);
        }
        .field select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='7' fill='none' stroke='%231F6A8F' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m1 1 4.5 5 4.5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 38px;
        }
        .field input:hover,
        .field select:hover {
            border-color: var(--steel);
        }
        .field input:focus,
        .field select:focus {
            outline: 0;
            border-color: var(--teal);
            box-shadow: 0 0 0 4px #1F6A8F1A, var(--shadow-sm);
            transform: translateY(-1px);
        }
        .field input::placeholder { color: #94B0C2; }
        .field input[readonly] { background: #EEF4F7; color: var(--muted); box-shadow: none; }
        .field.invalid input,
        .field.invalid select {
            border-color: var(--error);
            box-shadow: 0 0 0 3px #C0392B12;
        }

        .err-msg[hidden] { display: none; }
        .err-msg {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            font-size: 11.5px;
            line-height: 1.5;
            color: var(--error);
            font-weight: 600;
        }
        .err-msg::before { content: '⚠'; font-size: 11px; }

        /* ============================================================
           EDUCATION LEVEL CARDS
        ============================================================ */
        .level-pick {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        .level-pick input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .level-card {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 18px 20px;
            border: 1.5px solid #CDDDE7;
            border-radius: var(--radius);
            background: var(--card);
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s, background .2s, transform .2s;
            height: 100%;
            box-shadow: var(--shadow-sm);
        }
        .level-card strong {
            font-family: 'Manrope', sans-serif;
            font-size: 15px;
            letter-spacing: -.04em;
            color: var(--navy);
        }
        .level-card small {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.4;
        }
        .level-card:hover {
            border-color: var(--steel);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }
        .level-pick input:checked + .level-card {
            border-color: var(--teal);
            background: linear-gradient(135deg, #E6F2F9, #F0F7FA);
            box-shadow: 0 0 0 4px #1F6A8F18, var(--shadow-md);
        }
        .level-pick input:checked + .level-card strong { color: var(--teal); }
        .level-pick input:focus-visible + .level-card { outline: 2px solid var(--teal); outline-offset: 3px; }
        .level-wrap { position: relative; }
        .conditional { display: none; }
        .conditional.show { display: contents; }

        /* ============================================================
           PASSWORD
        ============================================================ */
        .password-wrap { position: relative; }
        .password-wrap input { padding-right: 70px; }
        .show-pass {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            padding: 7px 5px;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--teal);
            letter-spacing: .02em;
        }
        .show-pass:hover { color: var(--navy); }

        /* Password strength */
        .strength {
            display: flex;
            gap: 5px;
            margin-top: 9px;
        }
        .strength i {
            flex: 1;
            height: 3px;
            border-radius: 3px;
            background: var(--line);
            transition: background .3s;
        }
        .strength[data-level="1"] i:nth-child(-n+1) { background: #D9604F; }
        .strength[data-level="2"] i:nth-child(-n+2) { background: #E3A33F; }
        .strength[data-level="3"] i:nth-child(-n+3) { background: var(--steel); }
        .strength[data-level="4"] i:nth-child(-n+4) { background: var(--teal); }
        .strength-text {
            font-size: 11.5px;
            color: var(--muted);
            margin-top: 5px;
            min-height: 16px;
            font-weight: 500;
        }

        /* ============================================================
           TERMS
        ============================================================ */
        .terms {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            font-size: 13px;
            line-height: 1.65;
            color: var(--muted);
            cursor: pointer;
        }
        .field .terms input {
            accent-color: var(--teal);
            width: 18px; height: 18px;
            min-width: 18px;
            margin: 2px 0 0;
            padding: 0;
            flex: none;
            appearance: auto;
            -webkit-appearance: checkbox;
            transform: none;
            box-shadow: none;
        }
        .terms a { color: var(--teal); font-weight: 700; border-bottom: 1px solid transparent; }
        .terms a:hover { border-color: var(--teal); }

        /* ============================================================
           ACTION BUTTONS
        ============================================================ */
        .actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            align-items: center;
        }
        .btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            height: 52px;
            border-radius: var(--radius-sm);
            padding: 0 26px;
            font-size: 13.5px;
            font-weight: 700;
            border: 1.5px solid transparent;
            overflow: hidden;
            transition: background .25s, transform .25s, box-shadow .25s, color .25s, border-color .25s;
            letter-spacing: .01em;
        }
        .btn[hidden] { display: none; }

        .btn-primary {
            flex: 1;
            background: var(--navy);
            color: #fff;
            border-color: var(--navy);
            box-shadow: var(--shadow-md);
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--teal);
            transform: translateX(-101%);
            transition: transform .45s cubic-bezier(.16, 1, .3, 1);
        }
        .btn-primary:hover::before { transform: translateX(0); }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px #1F6A8F38;
        }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary span, .btn-primary .arrow { position: relative; z-index: 1; }
        .btn-primary .arrow { transition: transform .3s; }
        .btn-primary:hover .arrow { transform: translate(3px, -3px); }

        .btn-ghost {
            background: var(--card);
            border-color: #CCDDE7;
            color: var(--navy);
            box-shadow: var(--shadow-sm);
        }
        .btn-ghost:hover {
            background: var(--paper);
            border-color: var(--steel);
            transform: translateY(-1px);
        }

        /* ============================================================
           BOTTOM
        ============================================================ */
        .bottom-hint {
            font-size: 13px;
            color: var(--muted);
            text-align: center;
            margin: 24px 0 0;
        }
        .bottom-hint a { color: var(--teal); font-weight: 800; }
        .bottom-hint a:hover { text-decoration: underline; text-underline-offset: 3px; }

        .bottom-meta {
            font-size: 11.5px;
            color: #8AABBF;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--line);
        }
        .bottom-meta a:hover { text-decoration: underline; color: var(--teal); }

        /* ============================================================
           ANIMATIONS
        ============================================================ */
        @keyframes comeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(16px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 960px) {
            .auth-shell { grid-template-columns: 1fr; }
            .brand-side {
                position: relative;
                height: auto;
                padding: 20px 24px;
            }
            .brand-side .side-content,
            .brand-side .side-footer { display: none; }
            .brand-side .deco-ring::before,
            .brand-side .deco-ring::after,
            .brand-glow, .brand-glow-2 { display: none; }
            .wordmark { font-size: 20px; }
            .brand-mark { width: 34px; height: 34px; }
            .auth-main { padding: 24px 22px 20px; }
            .top-nav { justify-content: space-between; }
            .back-mobile { display: inline-flex; color: var(--teal); font-weight: 600; border: 0 !important; padding: 0; background: none; box-shadow: none; }
            .form-layout { padding: 32px 0 28px; }
        }
        @media (max-width: 620px) {
            .c2, .c3, .c4 { grid-column: span 6; }
            .c2.keep { grid-column: span 3; }
            .level-pick { grid-template-columns: 1fr; }
            .top-nav span { display: none; }
            .stepper li { font-size: 10px; }
            .stepper .label-long { display: none; }
            .step-card { padding: 22px 18px 18px; }
            .bottom-meta { font-size: 10.5px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>
<body>
@php
    $courses = [
        'BS Accountancy','BS Agriculture','BS Architecture','BS Biology','BS Business Administration',
        'BS Civil Engineering','BS Computer Engineering','BS Computer Science','BS Criminology',
        'BS Electrical Engineering','BS Electronics Engineering','BS Hospitality Management','BS Information Technology',
        'BS Marine Engineering','BS Marine Transportation','BS Mechanical Engineering','BS Medical Technology',
        'BS Nursing','BS Pharmacy','BS Psychology','BS Tourism Management','Bachelor of Elementary Education',
        'Bachelor of Secondary Education','Bachelor of Arts in Communication','Bachelor of Fine Arts',
    ];
    $level = old('education_level');
@endphp

<div class="auth-shell">

    {{-- ============================================================
         BRAND SIDE
    ============================================================ --}}
    <aside class="brand-side" aria-label="ScholarHunt introduction">
        <span class="deco-ring" aria-hidden="true"></span>
        <span class="brand-glow" aria-hidden="true"></span>
        <span class="brand-glow-2" aria-hidden="true"></span>

        <a class="wordmark" href="{{ route('landing') }}" aria-label="ScholarHunt home">
            <span class="brand-mark">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/>
                    <path d="M7 11v5c3 2 7 2 10 0v-5"/>
                </svg>
            </span>
            ScholarHunt
        </a>

        <div class="side-content">
            <span class="eyebrow">Start your search</span>
            <h2>Tell us about you. We'll find the fit.</h2>
            <p>A few details about your school and where you're from lets ScholarHunt surface scholarships you may actually qualify for.</p>

            <div class="side-divider"></div>

            <ul class="perks">
                <li>
                    <span class="perk-icon">
                        <svg viewBox="0 0 24 24"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg>
                    </span>
                    Matched to your grade, strand, or course
                </li>
                <li>
                    <span class="perk-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                    </span>
                    Deadline reminders so nothing slips by
                </li>
                <li>
                    <span class="perk-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2ZM8 12h8"/><path d="M12 8v8"/></svg>
                    </span>
                    Free for students, always
                </li>
            </ul>
        </div>

        <div class="side-footer">Find opportunities. Follow your progress.</div>
    </aside>

    {{-- ============================================================
         MAIN
    ============================================================ --}}
    <main class="auth-main">
        <nav class="top-nav" aria-label="Account navigation">
            <a href="{{ route('landing') }}" class="back-mobile">← Back</a>
            <span>Already have an account?</span>
            <a href="{{ route('login') }}">Log in ↗</a>
        </nav>

        <section class="form-layout" aria-labelledby="register-title">
            <p class="welcome-label">Join ScholarHunt</p>
            <h1 id="register-title">Create your account.</h1>
            <p class="subtitle">It takes about three minutes. Fields marked <span style="color:var(--teal);font-weight:700">*</span> are required.</p>

            {{-- Stepper --}}
            <ol class="stepper" id="stepper" aria-label="Sign-up progress">
                <li class="active">
                    <div class="bar"><div class="bar-fill"></div></div>
                    <div class="step-meta">
                        <span class="num">1</span>
                        <span>Personal<span class="label-long"> info</span></span>
                    </div>
                </li>
                <li>
                    <div class="bar"><div class="bar-fill"></div></div>
                    <div class="step-meta">
                        <span class="num">2</span>
                        <span>School<span class="label-long"> details</span></span>
                    </div>
                </li>
                <li>
                    <div class="bar"><div class="bar-fill"></div></div>
                    <div class="step-meta">
                        <span class="num">3</span>
                        <span>Address<span class="label-long"> &amp; account</span></span>
                    </div>
                </li>
            </ol>

            @if (session('status'))
                <div class="form-notice" role="status">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="form-notice err" role="alert">
                    Please fix the highlighted fields before continuing.
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}" id="register-form" novalidate>
                @csrf

                {{-- ====================================================
                     STEP 1 — PERSONAL
                ==================================================== --}}
                <fieldset class="step active" data-step="0">
                    <div class="step-card">
                        <div class="step-card-header">
                            <legend>Personal information</legend>
                            <p class="hint">Use your name as it appears on your school records.</p>
                        </div>
                        <div class="grid">
                            <div class="field c2 @error('first_name') invalid @enderror">
                                <label for="first_name">First name<span class="req">*</span></label>
                                <input id="first_name" name="first_name" type="text" autocomplete="given-name" placeholder="Juan" value="{{ old('first_name') }}" required maxlength="80">
                                @error('first_name')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c2 @error('middle_name') invalid @enderror">
                                <label for="middle_name">Middle name<span class="opt">(optional)</span></label>
                                <input id="middle_name" name="middle_name" type="text" autocomplete="additional-name" placeholder="Santos" value="{{ old('middle_name') }}" maxlength="80">
                                @error('middle_name')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c2 @error('surname') invalid @enderror">
                                <label for="surname">Surname<span class="req">*</span></label>
                                <input id="surname" name="surname" type="text" autocomplete="family-name" placeholder="Dela Cruz" value="{{ old('surname') }}" required maxlength="80">
                                @error('surname')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="field c2 @error('birthday') invalid @enderror">
                                <label for="birthday">Birthday<span class="req">*</span></label>
                                <input id="birthday" name="birthday" type="date" autocomplete="bday" value="{{ old('birthday') }}" required min="1930-01-01" max="{{ date('Y-m-d') }}">
                                @error('birthday')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c2 keep @error('age') invalid @enderror">
                                <label for="age">Age<span class="req">*</span></label>
                                <input id="age" name="age" type="number" inputmode="numeric" placeholder="18" min="12" max="80" value="{{ old('age') }}" required>
                                @error('age')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c2 keep @error('sex') invalid @enderror">
                                <label for="sex">Sex<span class="req">*</span></label>
                                <select id="sex" name="sex" required>
                                    <option value="" disabled {{ old('sex') ? '' : 'selected' }}>Select</option>
                                    <option value="male"   @selected(old('sex') === 'male')>Male</option>
                                    <option value="female" @selected(old('sex') === 'female')>Female</option>
                                </select>
                                @error('sex')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="field c3 @error('email') invalid @enderror">
                                <label for="email">Email address<span class="req">*</span></label>
                                <input id="email" name="email" type="email" autocomplete="email" placeholder="you@example.com" value="{{ old('email') }}" required maxlength="254">
                                @error('email')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c3 @error('contact_number') invalid @enderror">
                                <label for="contact_number">Contact number<span class="req">*</span></label>
                                <input id="contact_number" name="contact_number" type="tel" inputmode="tel" autocomplete="tel" placeholder="09171234567" value="{{ old('contact_number') }}" required pattern="^(09|\+639)\d{9}$" maxlength="13" data-msg="Use a Philippine mobile number, e.g. 09171234567.">
                                @error('contact_number')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </fieldset>

                {{-- ====================================================
                     STEP 2 — SCHOOL
                ==================================================== --}}
                <fieldset class="step" data-step="1">
                    <div class="step-card">
                        <div class="step-card-header">
                            <legend>School details</legend>
                            <p class="hint">This helps us match you with scholarships for your level.</p>
                        </div>
                        <div class="grid">
                            <div class="field c6 @error('education_level') invalid @enderror">
                                <label id="level-label">Current level<span class="req">*</span></label>
                                <div class="level-pick" role="radiogroup" aria-labelledby="level-label">
                                    <div class="level-wrap">
                                        <input type="radio" id="lvl-shs" name="education_level" value="shs" {{ $level === 'shs' ? 'checked' : '' }} required>
                                        <label class="level-card" for="lvl-shs" style="margin:0">
                                            <strong>Senior High School</strong>
                                            <small>Grade 11 or Grade 12</small>
                                        </label>
                                    </div>
                                    <div class="level-wrap">
                                        <input type="radio" id="lvl-college" name="education_level" value="college" {{ $level === 'college' ? 'checked' : '' }}>
                                        <label class="level-card" for="lvl-college" style="margin:0">
                                            <strong>College</strong>
                                            <small>Any year level and course</small>
                                        </label>
                                    </div>
                                </div>
                                @error('education_level')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            {{-- SHS only --}}
                            <div class="conditional {{ $level === 'shs' ? 'show' : '' }}" id="shs-fields">
                                <div class="field c2 @error('shs_grade') invalid @enderror">
                                    <label for="shs_grade">Grade level<span class="req">*</span></label>
                                    <select id="shs_grade" name="shs_grade" data-required-for="shs">
                                        <option value="" disabled {{ old('shs_grade') ? '' : 'selected' }}>Select</option>
                                        <option value="11" @selected(old('shs_grade') === '11')>Grade 11</option>
                                        <option value="12" @selected(old('shs_grade') === '12')>Grade 12</option>
                                    </select>
                                    @error('shs_grade')<span class="err-msg">{{ $message }}</span>@enderror
                                </div>
                                <div class="field c4 @error('shs_strand') invalid @enderror">
                                    <label for="shs_strand">Strand / track<span class="req">*</span></label>
                                    <select id="shs_strand" name="shs_strand" data-required-for="shs">
                                        <option value="" disabled {{ old('shs_strand') ? '' : 'selected' }}>Select your strand</option>
                                        @foreach ($strands as $value => $label)
                                            <option value="{{ $value }}" @selected(old('shs_strand') === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('shs_strand')<span class="err-msg">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            {{-- College only --}}
                            <div class="conditional {{ $level === 'college' ? 'show' : '' }}" id="college-fields">
                                <div class="field c2 @error('college_year') invalid @enderror">
                                    <label for="college_year">Year level<span class="req">*</span></label>
                                    <select id="college_year" name="college_year" data-required-for="college">
                                        <option value="" disabled {{ old('college_year') ? '' : 'selected' }}>Select</option>
                                        @foreach (['1' => '1st year', '2' => '2nd year', '3' => '3rd year', '4' => '4th year', '5' => '5th year'] as $v => $l)
                                            <option value="{{ $v }}" @selected(old('college_year') === (string) $v)>{{ $l }}</option>
                                        @endforeach
                                    </select>
                                    @error('college_year')<span class="err-msg">{{ $message }}</span>@enderror
                                </div>
                                <div class="field c4 @error('college_course') invalid @enderror">
                                    <label for="college_course">Course / program<span class="req">*</span></label>
                                    <input id="college_course" name="college_course" type="text" list="course-list" placeholder="Start typing, e.g. BS Information Technology" value="{{ old('college_course') }}" maxlength="150" data-required-for="college" autocomplete="off">
                                    <datalist id="course-list">
                                        @foreach ($courses as $course)<option value="{{ $course }}"></option>@endforeach
                                    </datalist>
                                    @error('college_course')<span class="err-msg">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="field c6 @error('school_name') invalid @enderror">
                                <label for="school_name">School name<span class="req">*</span></label>
                                <input id="school_name" name="school_name" type="text" placeholder="e.g. Cavite National High School" value="{{ old('school_name') }}" required maxlength="150">
                                @error('school_name')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c6 @error('school_address') invalid @enderror">
                                <label for="school_address">School address<span class="req">*</span></label>
                                <input id="school_address" name="school_address" type="text" placeholder="Street, barangay, city / municipality, province" value="{{ old('school_address') }}" required maxlength="255">
                                @error('school_address')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </fieldset>

                {{-- ====================================================
                     STEP 3 — ADDRESS & ACCOUNT
                ==================================================== --}}
                <fieldset class="step" data-step="2">
                    <div class="step-card">
                        <div class="step-card-header">
                            <legend>Address &amp; account</legend>
                            <p class="hint">Your home address helps us find scholarships open to your area.</p>
                        </div>
                        <div class="grid">
                            <div class="section-title">Your address</div>
                            <div class="field c6 @error('address_street') invalid @enderror">
                                <label for="address_street">House no. / street<span class="req">*</span></label>
                                <input id="address_street" name="address_street" type="text" autocomplete="address-line1" placeholder="Blk 5 Lot 12, Mabini Street" value="{{ old('address_street') }}" required maxlength="150">
                                @error('address_street')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c3 @error('address_barangay') invalid @enderror">
                                <label for="address_barangay">Barangay<span class="req">*</span></label>
                                <input id="address_barangay" name="address_barangay" type="text" autocomplete="address-line2" placeholder="Barangay" value="{{ old('address_barangay') }}" required maxlength="100">
                                @error('address_barangay')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c3 @error('address_city') invalid @enderror">
                                <label for="address_city">City / municipality<span class="req">*</span></label>
                                <input id="address_city" name="address_city" type="text" autocomplete="address-level2" placeholder="City or municipality" value="{{ old('address_city') }}" required maxlength="100">
                                @error('address_city')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c4 @error('address_province') invalid @enderror">
                                <label for="address_province">Province<span class="req">*</span></label>
                                <input id="address_province" name="address_province" type="text" autocomplete="address-level1" placeholder="Province" value="{{ old('address_province') }}" required maxlength="100">
                                @error('address_province')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c2 @error('address_zip') invalid @enderror">
                                <label for="address_zip">ZIP code<span class="req">*</span></label>
                                <input id="address_zip" name="address_zip" type="text" inputmode="numeric" autocomplete="postal-code" placeholder="4100" value="{{ old('address_zip') }}" required pattern="\d{4}" maxlength="4" data-msg="ZIP code must be 4 digits.">
                                @error('address_zip')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="section-title">Secure your account</div>
                            <div class="field c3 @error('password') invalid @enderror">
                                <label for="password">Password<span class="req">*</span></label>
                                <div class="password-wrap">
                                    <input id="password" name="password" type="password" autocomplete="new-password" placeholder="At least 8 characters" required minlength="8">
                                    <button class="show-pass" type="button" data-toggle="password" aria-label="Show password" aria-pressed="false">Show</button>
                                </div>
                                <div class="strength" id="strength" data-level="0" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
                                <div class="strength-text" id="strength-text">Use letters and numbers.</div>
                                @error('password')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="field c3">
                                <label for="password_confirmation">Confirm password<span class="req">*</span></label>
                                <div class="password-wrap">
                                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Re-enter password" required>
                                    <button class="show-pass" type="button" data-toggle="password_confirmation" aria-label="Show password" aria-pressed="false">Show</button>
                                </div>
                                <span class="err-msg" id="match-msg" hidden>Passwords don't match.</span>
                            </div>

                            <div class="field c6 @error('terms') invalid @enderror">
                                <label class="terms" for="terms" style="font-weight:400;margin:0">
                                    <input id="terms" name="terms" type="checkbox" value="1" required {{ old('terms') ? 'checked' : '' }}>
                                    <span>I agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>, and consent to ScholarHunt using my details to match me with scholarships.</span>
                                </label>
                                @error('terms')<span class="err-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="actions">
                    <button class="btn btn-ghost" type="button" id="back-btn" hidden>← Back</button>
                    <button class="btn btn-primary" type="button" id="next-btn">
                        <span id="next-label">Continue</span>
                        <span class="arrow" aria-hidden="true">→</span>
                    </button>
                </div>
            </form>

            <p class="bottom-hint">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </section>

        <div class="bottom-meta">
            <span>© {{ date('Y') }} ScholarHunt</span>
            <a href="{{ route('landing') }}">← Return to homepage</a>
        </div>
    </main>
</div>

<script>
(() => {
    const form = document.getElementById('register-form');
    const steps = [...form.querySelectorAll('.step')];
    const stepperItems = [...document.querySelectorAll('#stepper li')];
    const nextBtn = document.getElementById('next-btn');
    const nextLabel = document.getElementById('next-label');
    const backBtn = document.getElementById('back-btn');
    let current = 0;

    /* ---------- Conditional SHS / College fields ---------- */
    const shs = document.getElementById('shs-fields');
    const college = document.getElementById('college-fields');
    function syncLevel() {
        const val = form.querySelector('input[name="education_level"]:checked')?.value;
        shs.classList.toggle('show', val === 'shs');
        college.classList.toggle('show', val === 'college');
        form.querySelectorAll('[data-required-for]').forEach(el => {
            el.required = el.dataset.requiredFor === val;
            if (el.dataset.requiredFor !== val) { el.value = ''; if (el.tagName === 'SELECT') el.selectedIndex = 0; }
        });
    }
    form.querySelectorAll('input[name="education_level"]').forEach(r => r.addEventListener('change', syncLevel));
    syncLevel();

    /* ---------- Birthday -> age ---------- */
    const birthday = document.getElementById('birthday');
    const age = document.getElementById('age');
    birthday.addEventListener('change', () => {
        if (!birthday.value) return;
        const b = new Date(birthday.value), t = new Date();
        let a = t.getFullYear() - b.getFullYear();
        const m = t.getMonth() - b.getMonth();
        if (m < 0 || (m === 0 && t.getDate() < b.getDate())) a--;
        if (a >= 0 && a < 120) { age.value = a; clearError(age); }
    });

    /* ---------- Validation helpers ---------- */
    function showError(el, msg) {
        const field = el.closest('.field');
        field.classList.add('invalid');
        let box = field.querySelector('.err-msg.js');
        if (!box) {
            box = document.createElement('span');
            box.className = 'err-msg js';
            box.setAttribute('role', 'alert');
            field.appendChild(box);
        }
        box.textContent = msg;
    }
    function clearError(el) {
        const field = el.closest('.field');
        if (!field) return;
        field.classList.remove('invalid');
        field.querySelectorAll('.err-msg').forEach(e => { if (e.id !== 'match-msg') e.remove(); });
    }
    function validateStep(index) {
        const scope = steps[index];
        let firstBad = null;
        const controls = [...scope.querySelectorAll('input, select')].filter(el => {
            if (el.disabled || el.type === 'hidden') return false;
            const cond = el.closest('.conditional');
            return !cond || cond.classList.contains('show');
        });
        const radiosChecked = new Set();
        controls.forEach(el => {
            clearError(el);
            if (el.type === 'radio') {
                if (radiosChecked.has(el.name)) return;
                radiosChecked.add(el.name);
                if (!form.querySelector(`input[name="${el.name}"]:checked`)) {
                    showError(el, 'Please choose one.'); firstBad = firstBad || el;
                }
                return;
            }
            if (!el.checkValidity()) {
                let msg = el.dataset.msg || el.validationMessage;
                if (el.validity.valueMissing) msg = el.type === 'checkbox' ? 'Please tick this box to continue.' : 'This field is required.';
                else if (el.validity.typeMismatch && el.type === 'email') msg = 'Enter a valid email address.';
                else if (el.validity.rangeUnderflow || el.validity.rangeOverflow) msg = el.type === 'date' ? 'Enter a valid date.' : 'Enter a realistic value.';
                else if (el.validity.tooShort) msg = 'Use at least 8 characters.';
                showError(el, msg);
                firstBad = firstBad || el;
            }
        });
        if (index === 2) {
            const p = document.getElementById('password'), c = document.getElementById('password_confirmation');
            const matchMsg = document.getElementById('match-msg');
            const ok = p.value === c.value;
            matchMsg.hidden = ok;
            c.closest('.field').classList.toggle('invalid', !ok);
            if (!ok) firstBad = firstBad || c;
            if (p.value && !(/[A-Za-z]/.test(p.value) && /\d/.test(p.value))) {
                showError(p, 'Password needs both letters and numbers.'); firstBad = firstBad || p;
            }
        }
        if (firstBad) { firstBad.focus({preventScroll:false}); return false; }
        return true;
    }

    /* ---------- Stepper ---------- */
    function go(index) {
        current = index;
        steps.forEach((s, i) => s.classList.toggle('active', i === index));
        stepperItems.forEach((li, i) => {
            li.classList.toggle('active', i === index);
            li.classList.toggle('done', i < index);
        });
        backBtn.hidden = index === 0;
        const last = index === steps.length - 1;
        nextLabel.textContent = last ? 'Create my account' : 'Continue';
        nextBtn.querySelector('.arrow').textContent = last ? '↗' : '→';
        document.getElementById('register-title').scrollIntoView({behavior: 'smooth', block: 'start'});
    }
    nextBtn.addEventListener('click', () => {
        if (!validateStep(current)) return;
        if (current < steps.length - 1) go(current + 1);
        else {
            for (let i = 0; i < steps.length - 1; i++) {
                if (!validateStep(i)) { go(i); return; }
            }
            nextBtn.disabled = true;
            nextLabel.textContent = 'Creating account…';
            form.submit();
        }
    });
    backBtn.addEventListener('click', () => go(Math.max(0, current - 1)));
    form.addEventListener('keydown', e => {
        if (e.key === 'Enter' && e.target.tagName !== 'BUTTON' && e.target.type !== 'checkbox') {
            e.preventDefault(); nextBtn.click();
        }
    });
    form.addEventListener('input', e => { if (e.target.closest('.field')) clearError(e.target); });
    form.addEventListener('change', e => { if (e.target.closest('.field')) clearError(e.target); });

    const serverError = form.querySelector('.field.invalid');
    if (serverError) {
        const stepEl = serverError.closest('.step');
        go(steps.indexOf(stepEl));
    }

    /* ---------- Show / hide password ---------- */
    document.querySelectorAll('[data-toggle]').forEach(btn => btn.addEventListener('click', () => {
        const input = document.getElementById(btn.dataset.toggle);
        const visible = input.type === 'password';
        input.type = visible ? 'text' : 'password';
        btn.textContent = visible ? 'Hide' : 'Show';
        btn.setAttribute('aria-label', visible ? 'Hide password' : 'Show password');
        btn.setAttribute('aria-pressed', String(visible));
    }));

    /* ---------- Password strength ---------- */
    const pw = document.getElementById('password');
    const meter = document.getElementById('strength');
    const meterText = document.getElementById('strength-text');
    const labels = ['Use letters and numbers.', 'Weak — add more characters.', 'Fair — mix in numbers or capitals.', 'Good', 'Strong'];
    pw.addEventListener('input', () => {
        const v = pw.value; let score = 0;
        if (v.length >= 8) score++;
        if (/[a-z]/.test(v) && /[A-Z]/.test(v)) score++;
        if (/\d/.test(v)) score++;
        if (/[^A-Za-z0-9]/.test(v) || v.length >= 12) score++;
        if (!v) score = 0;
        meter.dataset.level = score;
        meterText.textContent = labels[score];
    });
    document.getElementById('password_confirmation').addEventListener('input', () => {
        document.getElementById('match-msg').hidden = true;
    });
})();
</script>
</body>
</html>
