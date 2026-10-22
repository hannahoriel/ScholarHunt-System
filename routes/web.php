<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FeedController;
<<<<<<< HEAD
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\TrackerController;
=======
use App\Http\Controllers\ReviewerController;
>>>>>>> origin/master
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.landing-page')->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.submit');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('demo.or.auth')->group(function () {
    Route::view('/dashboard', 'pages.dashboard.dashboard-home')->name('dashboard');
    Route::get('/feed', [FeedController::class, 'index'])->name('dashboard.discover');
    Route::get('/dashboard/reviewer', [ReviewerController::class, 'index'])->name('dashboard.reviewer');
    Route::get('/dashboard/reviewer/{subject}/download', [ReviewerController::class, 'download'])->name('dashboard.reviewer.download');

    Route::get('/dashboard/tracker', [TrackerController::class, 'index'])->name('dashboard.tracker');
    Route::post('/dashboard/tracker', [TrackerController::class, 'store'])->name('dashboard.tracker.store');
    Route::patch('/dashboard/tracker/{application}', [TrackerController::class, 'update'])->name('dashboard.tracker.update');
    Route::delete('/dashboard/tracker/{application}', [TrackerController::class, 'destroy'])->name('dashboard.tracker.destroy');

<<<<<<< HEAD
    Route::get('/dashboard/profile', [ProfileController::class, 'edit'])->name('dashboard.profile');
    Route::put('/dashboard/profile', [ProfileController::class, 'update'])->name('dashboard.profile.update');
    Route::put('/dashboard/profile/password', [ProfileController::class, 'password'])->name('dashboard.profile.password');
=======
    // Signed verification link the user clicks from their inbox
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    // Resend the verification email
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

// ─── Verified users only ──────────────────────────────────────────────────────

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'pages.dashboard.dashboard-home')->name('dashboard');
    Route::get('/feed', [FeedController::class, 'index'])->name('dashboard.discover');
    Route::get('/dashboard/reviewer', [ReviewerController::class, 'index'])->name('dashboard.reviewer');
    Route::get('/dashboard/reviewer/{subject}/download', [ReviewerController::class, 'download'])
        ->name('dashboard.reviewer.download');
>>>>>>> origin/master
});
