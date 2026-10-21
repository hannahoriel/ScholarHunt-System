@extends('pages.dashboard.app')
@section('title', 'Reviewer & Mock Exams')
@push('styles')
    @vite('resources/css/reviewer.css')
@endpush
@section('content')
<div class="reviewer-page" id="reviewerPage">
    <header class="reviewer-hero">
        <div class="reviewer-hero-copy">
            <a class="reviewer-back-link" href="{{ route('dashboard') }}">← <span>Back to dashboard</span></a>
            <span class="reviewer-eyebrow"><i></i> SCHOLARHUNT STUDY CENTER</span>
            <h1>Prepare with purpose.<br><em>Practice with confidence.</em></h1>
            <p>Review core subjects, choose a provided reviewer or mock exam, or upload your own PDF and turn it into a practice quiz.</p>
            <div class="reviewer-hero-stats"><span><b>9</b> subject areas</span><span><b>1</b> quiz format</span><span><b>PDF</b> upload support</span></div>
        </div>
        <div class="reviewer-hero-art" aria-hidden="true"><div class="reviewer-orbit"></div><div class="reviewer-book"><b>✓</b><i></i><i></i><i></i><i></i></div><span class="float-note">✦ Study smarter</span></div>
    </header>

    <section class="reviewer-section">
        <div class="section-heading"><div><span class="kicker">START WITH A SUBJECT</span><h2>What do you want to review?</h2><p>Choose a category to focus your practice.</p></div><input class="subject-search" id="subjectSearch" type="search" placeholder="⌕  Find a subject..." aria-label="Find a subject"></div>
        <div class="subject-grid" id="subjectGrid">
            <button class="subject-card selected" data-subject="all"><span class="subject-icon">✦</span><span><b>All subjects</b><small>Mixed practice set</small></span><i>↗</i></button>
            <button class="subject-card" data-subject="logic"><span class="subject-icon purple">◈</span><span><b>Abstract & Logic</b><small>Patterns, sequences, reasoning</small></span><i>↗</i></button>
            <button class="subject-card" data-subject="english"><span class="subject-icon blue">Aa</span><span><b>English</b><small>Language, grammar, vocabulary</small></span><i>↗</i></button>
            <button class="subject-card" data-subject="science"><span class="subject-icon green">⚛</span><span><b>Science</b><small>Biology, physics, earth science</small></span><i>↗</i></button>
            <button class="subject-card" data-subject="math"><span class="subject-icon orange">÷</span><span><b>Mathematics</b><small>Arithmetic, decimals, fractions, ratios</small></span><i>↗</i></button>
            <button class="subject-card" data-subject="history"><span class="subject-icon coral">⌂</span><span><b>History</b><small>Philippine and world history</small></span><i>↗</i></button>
            <button class="subject-card" data-subject="filipino"><span class="subject-icon pink">文</span><span><b>Filipino</b><small>Wika, gramatika, talasalitaan</small></span><i>↗</i></button>
            <button class="subject-card" data-subject="civics"><span class="subject-icon slate">⚖</span><span><b>General Knowledge & Constitution</b><small>Civics, rights, government</small></span><i>↗</i></button>
            <button class="subject-card" data-subject="reading"><span class="subject-icon yellow">¶</span><span><b>Reading Comprehension</b><small>Main idea, inference, context clues</small></span><i>↗</i></button>
        </div>
    </section>

    <section class="reviewer-builder">
        <div class="builder-title"><span class="builder-icon">▤</span><div><span class="kicker">BUILD YOUR PRACTICE QUIZ</span><h2>Choose your study material</h2><p>Use a provided reviewer or upload your own PDF.</p></div></div>
        <div class="material-tabs" role="tablist"><button class="active" data-tab="provided" role="tab" aria-selected="true">Provided materials</button><button data-tab="upload" role="tab" aria-selected="false">Upload a PDF</button></div>
        <div class="material-panel" data-panel="provided">
            <div class="panel-heading"><div><h3>Reviewer library</h3><p>Select a topic or mock exam as your quiz source.</p></div><span>STARTER LIBRARY</span></div>
            <div class="provided-grid">
                <div class="provided-library-item">
                    <label class="provided-card chosen"><input type="radio" name="material" value="all" checked><span class="material-symbol">✦</span><b>All subjects</b><small>Mixed practice · 70 questions per subject</small><em>Use mixed practice set →</em></label>
                </div>
                @foreach ($mockExams as $key => $exam)
                    <div class="provided-library-item">
                        <label class="provided-card">
                            <input type="radio" name="material" value="{{ $key }}">
                            <span class="material-symbol">{{ ['logic' => '◈', 'english' => 'Aa', 'science' => '⚛', 'math' => '÷', 'history' => '⌂', 'filipino' => '文', 'civics' => '⚖', 'reading' => '¶'][$key] ?? '✦' }}</span>
                            <b>{{ $exam['title'] }}</b>
                            <small>{{ $exam['description'] }} · 70 questions</small>
                            <em>Use this mock exam →</em>
                        </label>
                        <a class="mock-exam-download" href="{{ route('dashboard.reviewer.download', ['subject' => $key]) }}">Download PDF</a>
                    </div>
                @endforeach
            </div>
            <p class="material-note">ⓘ These original practice questions are for review and are not official scholarship examination materials.</p>
        </div>
        <div class="material-panel hidden" data-panel="upload">
            <div class="upload-zone" id="uploadZone"><input type="file" id="reviewerPdf" accept=".pdf,application/pdf" hidden><div class="upload-icon">↑</div><h3>Drop your reviewer PDF here</h3><p>or browse your device to choose a file</p><button type="button" class="outline-btn" id="browsePdf">Choose PDF file</button><small>PDF only · Max 15 MB · Text-based PDFs work best</small></div>
            <div class="uploaded-file hidden" id="uploadedFile"><span class="pdf-icon">PDF</span><div><b id="fileName">reviewer.pdf</b><small id="fileMeta">Reading PDF text…</small></div><button type="button" id="removePdf" aria-label="Remove PDF">×</button></div>
            <p class="material-note" id="extractStatus">ⓘ Text is extracted in your browser. Scanned/image-only PDFs need OCR, which is not included in this prototype.</p>
        </div>

        <div class="quiz-settings">
            <span class="kicker">CUSTOMIZE YOUR QUIZ</span><h3>How would you like to practice?</h3>
            <div class="settings-grid">
                <fieldset><legend>Question type</legend><div class="quiz-types">
                    <label class="type-option selected"><input type="radio" name="quizType" value="multiple" checked><span>☷</span><b>Multiple choice<small>Choose the best answer</small></b></label>
                </div></fieldset>
                <div class="setting-count"><label for="questionCount">Number of questions</label><div class="count-control"><button type="button" id="countMinus">−</button><output id="countOutput">10</output><button type="button" id="countPlus">+</button></div><input id="questionCount" type="range" min="5" max="70" step="1" value="10"><div class="range-labels"><span>5 questions</span><span>70 questions</span></div>
                    <label for="quizSubject" class="subject-label">Quiz subject</label><select id="quizSubject"><option value="all">All subjects / Mixed</option><option value="logic">Abstract & Logic</option><option value="english">English</option><option value="science">Science</option><option value="math">Mathematics</option><option value="history">History</option><option value="filipino">Filipino</option><option value="civics">General Knowledge & Philippine Constitution</option><option value="reading">Reading Comprehension</option></select>
                </div>
            </div>
            <div class="builder-footer"><div><b id="estimatedTime">~5 minutes</b><small>Estimated practice time</small></div><button class="generate-btn" type="button" id="generateQuiz">Generate quiz <span>→</span></button></div>
            <p class="builder-error hidden" id="builderError" role="alert"></p>
        </div>
    </section>

    <section class="quiz-workspace hidden" id="quizWorkspace">
        <div class="quiz-head"><div><span class="kicker">YOUR PRACTICE SESSION</span><h2 id="quizTitle">Practice quiz</h2><p id="quizSubtitle">Answer each question, then check your results.</p></div><button type="button" class="outline-btn" id="editQuiz">← Edit quiz settings</button></div>
        <div class="progress-label"><span id="progressText">Question 1 of 10</span><span id="progressPercent">10%</span></div><div class="progress-track"><i id="progressBar"></i></div>
        <article class="question-card"><div class="question-meta"><span id="questionSubject">MATH</span><span id="questionNumber">QUESTION 01</span></div><h3 id="questionPrompt"></h3><div class="answer-area" id="answerArea"></div><div class="question-nav"><button type="button" class="outline-btn" id="previousQuestion">← Previous</button><button type="button" class="generate-btn" id="nextQuestion">Next question →</button><button type="button" class="generate-btn hidden" id="submitQuiz">Finish quiz ✓</button></div></article>
        <div class="quiz-result hidden" id="quizResult" aria-live="polite"></div>
    </section>
    <div class="reviewer-toast" id="reviewerToast" role="status" aria-live="polite"></div>
</div>
@endsection
@push('scripts')
    <script type="application/json" id="mock-exam-data">@json($mockQuestions)</script>
    @vite('resources/js/reviewer.js')
@endpush
