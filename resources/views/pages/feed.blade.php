@extends('pages.dashboard.app')

@section('title', 'Discover Scholarships')



@push('styles')
    @vite('resources/css/feed.css')
@endpush



@section('content')

    <div class="feed-toolbar" aria-label="Feed navigation">
        <a class="feed-nav-btn" href="{{ route('dashboard') }}" aria-label="Back to dashboard">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            <span>Back to dashboard</span>
        </a>
    </div>

    <div class="discovery-heading" id="scholarship-search">
        <div><span class="section-kicker">EXPLORE YOUR OPTIONS</span><h2>Discover scholarships</h2><p>Explore opportunities by student level, scholarship type, and application deadline.</p></div>
    </div>

    <label class="hero-search" for="q">

        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m16 16 5 5"/></svg>

        <input id="q" type="search" placeholder="Try “engineering”, “DOST”, or “cadet”" autocomplete="off">

        <button class="clear-btn" id="clear-q" type="button" hidden>Clear</button>

    </label>



    <div class="filters">

        <div class="filter-row">

            <span id="level-label">I'm a</span>

            <div class="seg" role="group" aria-labelledby="level-label" id="level-seg">

                <button type="button" data-level="all" aria-pressed="true">All students</button>

                <button type="button" data-level="shs" aria-pressed="false">Senior High School</button>

                <button type="button" data-level="college" aria-pressed="false">College</button>

            </div>

        </div>

        <div class="filter-row">

            <span id="type-label">Type</span>

            <div class="chips" role="group" aria-labelledby="type-label" id="type-chips">

                <button class="chip" type="button" data-type="all" aria-pressed="true">All types</button>

                @foreach ($types as $key => $label)

                    <button class="chip" type="button" data-type="{{ $key }}" aria-pressed="false">{{ $label }}</button>

                @endforeach

            </div>

        </div>

    </div>



    <div class="result-bar"><span id="result-count" aria-live="polite"></span><span>Sample listings for the prototype</span></div>

    <div class="grid" id="grid"></div>

    <div class="empty" id="empty">

        <h3>No scholarships match yet</h3>

        <p>Try a shorter keyword, or switch the student level or type filter.</p>

        <button class="btn btn-primary" id="reset" type="button">Reset search and filters</button>

    </div>



    <div class="modal-backdrop" id="modal-backdrop" aria-hidden="true">
        <section class="scholarship-modal" id="scholarship-modal" role="dialog" aria-modal="true" aria-labelledby="d-title" aria-describedby="d-summary" tabindex="-1">
            <header class="modal-head">
                <div class="modal-head-copy">
                    <span class="modal-kicker">Scholarship opportunity</span>
                    <h2 id="d-title">Scholarship title</h2>
                    <p class="modal-provider" id="d-provider"></p>
                    <div class="modal-head-meta">
                        <span class="type-tag" id="d-type"></span>
                        <span class="pill" id="d-status"></span>
                        <div class="lvls" id="d-levels"></div>
                    </div>
                </div>
                <button class="modal-close" id="modal-close" type="button" aria-label="Close scholarship details"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg></button>
            </header>
            <div class="modal-scroll" id="modal-scroll">
                <div class="modal-date-grid">
                    <div class="date-card"><small>APPLICATION OPENS</small><strong id="d-opens"></strong><em id="d-open-note"></em></div>
                    <div class="date-card"><small>APPLICATION DEADLINE</small><strong id="d-deadline"></strong><em id="d-left"></em></div>
                    <div class="date-card"><small>APPLICATION STATUS</small><strong id="d-status-text"></strong><em id="d-status-note"></em></div>
                </div>
                <section class="modal-section">
                    <div class="modal-section-head"><span class="modal-section-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5.5h16v13H4z"/><path d="M8 9h8M8 13h8M8 16h5"/></svg></span><h3>About this scholarship</h3></div>
                    <p id="d-summary"></p>
                </section>
                <div class="modal-two-col">
                    <section class="modal-section">
                        <div class="modal-section-head"><span class="modal-section-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v18M3 12h18"/><circle cx="12" cy="12" r="9"/></svg></span><h3>Scholarship benefits</h3></div>
                        <p id="d-benefits"></p>
                    </section>
                    <section class="modal-section">
                        <div class="modal-section-head"><span class="modal-section-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-6.5 8-6.5s8 2.5 8 6.5"/></svg></span><h3>Who can apply?</h3></div>
                        <p id="d-eligibility"></p>
                    </section>
                </div>
                <section class="modal-section">
                    <div class="modal-section-head"><span class="modal-section-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 4h8M9 3h6v3H9z"/><rect x="5" y="5" width="14" height="16" rx="2"/><path d="m8 12 2 2 5-5M8 17h8"/></svg></span><h3>Application requirements checklist</h3></div>
                    <p style="margin-bottom:13px">Prepare these documents before starting your application. Always confirm the final list on the official application portal.</p>
                    <ul class="detail-list" id="d-reqs"></ul>
                </section>
                <section class="modal-section">
                    <div class="modal-section-head"><span class="modal-section-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16M4 12h16M4 19h16"/><circle cx="8" cy="5" r="1"/><circle cx="8" cy="12" r="1"/><circle cx="8" cy="19" r="1"/></svg></span><h3>Before you apply</h3></div>
                    <ul class="detail-list" id="d-steps">
                        <li>Check the eligibility criteria and make sure the scholarship matches your current student level.</li>
                        <li>Prepare clear scans or photos of all required documents.</li>
                        <li>Confirm the current application period and deadline on the official portal.</li>
                        <li>Submit through the provider's designated application portal and save your confirmation.</li>
                    </ul>
                </section>
                <div class="modal-note" id="d-data-note">Prototype listing: confirm dates, eligibility, requirements, and application availability with the scholarship provider before submitting personal information.</div>
                <section class="application-panel">
                    <div><h3>Ready to apply?</h3><p id="d-application-note">Use the scholarship's application portal when a verified direct link is available. If not, check the provider's official program page for current instructions.</p></div>
                    <div class="application-actions">
                        <a class="btn btn-primary" id="d-apply-link" href="#" target="_blank" rel="noopener noreferrer" hidden>Open application portal ↗</a>
                        <a class="btn btn-ghost" id="d-official-link" href="#" target="_blank" rel="noopener noreferrer">Official program info ↗</a>
                    </div>
                </section>
            </div>
            <footer class="modal-foot">
                <span class="modal-foot-note">ScholarHunt helps you discover opportunities; final details are set by each provider.</span>
                <button class="btn btn-ghost" id="d-save" type="button" aria-pressed="false">Save to tracker</button>
            </footer>
        </section>
    </div>
    <div class="toast" id="toast" role="status"></div>

@endsection



@push('scripts')
    @php
        $feedData = [
            'scholarships' => $scholarships,
            'types' => $types,
            'trackedScholarshipIds' => $trackedScholarshipIds,
            'trackerStoreUrl' => route('dashboard.tracker.store'),
            'trackerUrl' => route('dashboard.tracker'),
        ];
    @endphp
    <script type="application/json" id="feed-data">@json($feedData)</script>
    @vite('resources/js/feed.js')
@endpush
