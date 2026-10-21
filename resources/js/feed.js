(() => {

    const { scholarships: DATA, types: TYPES } = JSON.parse(document.getElementById('feed-data').textContent);

    const LEVELS = { shs: 'Senior High', college: 'College' };

    const params = new URLSearchParams(window.location.search);
    const state = { q: (params.get('q') || '').trim(), level: 'all', type: 'all' };

    const $ = id => document.getElementById(id);

    const esc = s => String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));

    /* ---- Dates ---- */

    const parse = iso => { const [y, m, d] = iso.split('-').map(Number); return new Date(y, m - 1, d); };

    const today = (() => { const t = new Date(); return new Date(t.getFullYear(), t.getMonth(), t.getDate()); })();

    const fmt = iso => parse(iso).toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

    const days = (a, b) => Math.round((b - a) / 86400000);

    const plural = n => n + (n === 1 ? ' day' : ' days');

    function status(s) {

        const o = days(today, parse(s.opens)), d = days(today, parse(s.deadline));

        if (o > 0) return { key: 'upcoming', label: 'Opens in ' + plural(o), note: 'Not open yet', rank: 2 };

        if (d < 0) return { key: 'closed', label: 'Closed', note: 'Deadline has passed', rank: 3 };

        if (d <= 14) return { key: 'soon', label: 'Closing soon', note: d === 0 ? 'Due today' : plural(d) + ' left', rank: 0 };

        return { key: 'open', label: 'Open now', note: plural(d) + ' left', rank: 1 };

    }



    /* ---- Saved (localStorage; papalitan ng database kapag may backend na) ---- */

    const KEY = 'scholarhunt-saved';

    const loadSaved = () => { try { return JSON.parse(localStorage.getItem(KEY)) || []; } catch (_) { return []; } };

    const storeSaved = list => { try { localStorage.setItem(KEY, JSON.stringify(list)); } catch (_) {} };

    let saved = loadSaved();



    /* ---- Filter + render ---- */

    function matches(s) {

        if (state.level !== 'all' && !s.levels.includes(state.level)) return false;

        if (state.type !== 'all' && s.type !== state.type) return false;

        const hay = [s.title, s.provider, s.summary, s.tags, TYPES[s.type]].join(' ').toLowerCase();

        return state.q.toLowerCase().split(/\s+/).filter(Boolean).every(t => hay.includes(t));

    }

    function render() {


        const list = DATA.filter(matches).map(s => ({ s, st: status(s) }))

            .sort((a, b) => a.st.rank - b.st.rank || a.s.deadline.localeCompare(b.s.deadline));

        $('grid').innerHTML = list.map(({ s, st }) => `

            <button class="card" type="button" data-id="${esc(s.id)}">

                <div class="card-top"><span class="type-tag">${esc(TYPES[s.type])}</span><span class="pill ${st.key}">${esc(st.label)}</span></div>

                <h3>${esc(s.title)}</h3>

                <p class="prov">${esc(s.provider)}</p>

                <p class="sum">${esc(s.summary)}</p>

                <div class="lvls">${s.levels.map(l => `<span class="lvl">${LEVELS[l]}</span>`).join('')}</div>

                <div class="card-foot"><span>Deadline: <strong>${fmt(s.deadline)}</strong></span><span>${esc(st.note)}</span></div>

            </button>`).join('');

        $('empty').classList.toggle('show', list.length === 0);

        $('grid').hidden = list.length === 0;

        $('result-count').innerHTML = `<strong>${list.length}</strong> ${list.length === 1 ? 'scholarship' : 'scholarships'} found`;

        $('clear-q').hidden = !state.q;

    }



    $('q').addEventListener('input', e => { state.q = e.target.value.trim(); render(); });

    $('clear-q').addEventListener('click', () => { $('q').value = ''; state.q = ''; render(); $('q').focus(); });

    function bindGroup(id, attr, key) {

        $(id).addEventListener('click', e => {

            const b = e.target.closest('button'); if (!b) return;

            state[key] = b.dataset[attr];

            $(id).querySelectorAll('button').forEach(x => x.setAttribute('aria-pressed', String(x === b)));

            render();

        });

    }

    bindGroup('level-seg', 'level', 'level');

    bindGroup('type-chips', 'type', 'type');

    $('reset').addEventListener('click', () => {

        state.q = ''; state.level = 'all'; state.type = 'all'; $('q').value = '';

        document.querySelectorAll('#level-seg button, #type-chips button').forEach(b => b.setAttribute('aria-pressed', String(b.dataset.level === 'all' || b.dataset.type === 'all')));

        render();

    });



    /* ---- Scholarship details modal ---- */
    const modal = $('scholarship-modal');
    const backdrop = $('modal-backdrop');
    const toast = $('toast');
    let current = null, lastFocus = null, toastTimer;

    function say(msg) {
        toast.textContent = msg;
        toast.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toast.classList.remove('show'), 2200);
    }

    function syncSave() {
        const on = current && saved.includes(current.id);
        $('d-save').setAttribute('aria-pressed', String(!!on));
        $('d-save').textContent = on ? 'Saved to tracker ✓' : 'Save to tracker';
    }

    function safeHttpUrl(value) {
        try {
            const url = new URL(value);
            return ['http:', 'https:'].includes(url.protocol) ? url.href : null;
        } catch (_) { return null; }
    }

    function openModal(id, trigger) {
        const s = DATA.find(x => String(x.id) === String(id));
        if (!s) return;
        current = s;
        lastFocus = trigger;
        const st = status(s);
        const openDays = days(today, parse(s.opens));
        const deadlineDays = days(today, parse(s.deadline));

        $('d-status').className = 'pill ' + st.key;
        $('d-status').textContent = st.label;
        $('d-type').textContent = TYPES[s.type] || 'Scholarship';
        $('d-title').textContent = s.title || 'Scholarship opportunity';
        $('d-provider').textContent = s.provider || 'Provider not specified';
        $('d-levels').innerHTML = (Array.isArray(s.levels) ? s.levels : []).map(level => `<span class="lvl">${esc(LEVELS[level] || level)}</span>`).join('');
        $('d-opens').textContent = fmt(s.opens);
        $('d-open-note').textContent = openDays > 0 ? `Opens in ${plural(openDays)}` : (openDays === 0 ? 'Opens today' : 'Opening date has passed');
        $('d-deadline').textContent = fmt(s.deadline);
        $('d-left').textContent = deadlineDays < 0 ? 'Deadline has passed' : deadlineDays === 0 ? 'Due today — apply only if portal is open' : `${plural(deadlineDays)} remaining`;
        $('d-status-text').textContent = st.key === 'open' ? 'Accepting applications (listed)' : st.key === 'soon' ? 'Closing soon (listed)' : st.key === 'upcoming' ? 'Not open yet (listed)' : 'Deadline passed (listed)';
        $('d-status-note').textContent = 'Based on the dates in this prototype';
        $('d-summary').textContent = s.summary || 'No description has been provided for this listing.';
        $('d-benefits').textContent = s.benefits || 'Benefits have not been confirmed in this listing. Check the provider’s official program information.';
        $('d-eligibility').textContent = s.eligibility || 'Eligibility details are not available. Check the provider’s official program information.';
        $('d-reqs').innerHTML = (Array.isArray(s.requirements) ? s.requirements : []).map(r => `<li>${esc(r)}</li>`).join('') || '<li>Requirements have not been listed. Check the official program information.</li>';

        const directApply = safeHttpUrl(s.application_link || '');
        const official = safeHttpUrl(s.link || '');
        const applyEl = $('d-apply-link');
        const officialEl = $('d-official-link');
        applyEl.hidden = !directApply;
        if (directApply) applyEl.href = directApply;
        officialEl.hidden = !official;
        if (official) officialEl.href = official;
        $('d-application-note').textContent = directApply
            ? 'A direct application portal is listed below. Confirm that the portal is accepting applications before entering personal information.'
            : 'A direct application URL has not been verified for this listing. We are not presenting the provider homepage as an application form; use the official program information link to locate current application instructions.';
        $('d-data-note').textContent = s.is_sample === false
            ? 'Confirm the current application period, eligibility, and required documents with the provider before submitting personal information.'
            : 'Prototype/sample listing: dates, benefits, eligibility, requirements, and application availability may need verification with the provider before you apply.';

        syncSave();
        backdrop.classList.add('show');
        backdrop.setAttribute('aria-hidden', 'false');
        document.body.classList.add('locked');
        $('modal-scroll').scrollTop = 0;
        $('modal-close').focus();
    }

    function closeModal() {
        backdrop.classList.remove('show');
        backdrop.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('locked');
        if (lastFocus) lastFocus.focus();
    }

    $('grid').addEventListener('click', e => {
        const card = e.target.closest('.card');
        if (card) openModal(card.dataset.id, card);
    });
    $('modal-close').addEventListener('click', closeModal);
    backdrop.addEventListener('click', e => { if (e.target === backdrop) closeModal(); });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && backdrop.classList.contains('show')) closeModal();
        if (e.key === 'Tab' && backdrop.classList.contains('show')) {
            const focusable = [...modal.querySelectorAll('a[href]:not([hidden]),button:not([disabled]):not([hidden])')];
            if (!focusable.length) return;
            const first = focusable[0], last = focusable[focusable.length - 1];
            if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
            else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
        }
    });
    $('d-save').addEventListener('click', () => {
        if (!current) return;
        const was = saved.includes(current.id);
        saved = was ? saved.filter(x => x !== current.id) : [...saved, current.id];
        storeSaved(saved);
        syncSave();
        say(was ? 'Removed from your tracker' : 'Saved to your tracker');
    });

    $('q').value = state.q;
    render();

})();
