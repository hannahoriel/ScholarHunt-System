<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.landing-page')->name('landing');
Route::view('/login', 'pages.auth.login')->name('login');

// UI-only for now. Replace this with a real authentication handler later.
Route::post('/login', function () {
    return back()->withErrors(['email' => 'Login is not connected yet. Authentication will be added later.'])->withInput(request()->only('email'));
})->name('login.submit');