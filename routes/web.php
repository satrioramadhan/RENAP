<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers;
use App\Http\Controllers\Admin;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/google', [Auth\GoogleController::class, 'redirectToGoogle'])->name('google');
Route::get('/auth/google/callback', [Auth\GoogleController::class, 'handleGoogleCallback']);

Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [Auth\LoginController::class, 'login']);
Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');

Route::get('register', [Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [Auth\RegisterController::class, 'register']);

Route::get('email/verify', [Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [Auth\VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware(['signed']);
Route::post('email/resend', [Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::get('password/reset', [Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'is_admin'])->group(function() {
    Route::get('dashboard', Admin\DashboardController::class)->name('dashboard');
    Route::resource('accommodations', Admin\AccommodationController::class);
    Route::resource('users', Admin\UserController::class);
    Route::put('/users/{user}/toggle-admin', [Admin\UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('profile/edit', [Controllers\UserController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [Controllers\UserController::class, 'update'])->name('profile.update');
});

// Rute untuk SPK Renap
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/spk-home', [Controllers\SPKController::class, 'checkSPK'])->name('spk.home');
    Route::get('/spk-renap', [Controllers\SPKController::class, 'showAccommodations'])->name('spk.index');
    Route::post('/spk-renap/choose', [Controllers\SPKController::class, 'chooseAccommodations'])->name('spk.choose');
    Route::get('/spk-renap/distance', [Controllers\SPKController::class, 'inputDistance'])->name('spk.distance');
    Route::post('/spk-renap/distance', [Controllers\SPKController::class, 'storeDistance'])->name('spk.storeDistance');
    Route::get('/spk-renap/weights', [Controllers\SPKController::class, 'inputWeights'])->name('spk.weights');
    Route::post('/spk-renap/weights', [Controllers\SPKController::class, 'storeWeights'])->name('spk.storeWeights');
    Route::get('/spk-renap/results', [Controllers\SPKController::class, 'showResults'])->name('spk.results');
    Route::post('/spk-renap/reset', [Controllers\SPKController::class, 'resetSPK'])->name('spk.reset');
    Route::post('/spk-renap/reset/home', [Controllers\SPKController::class, 'backHome'])->name('back.home');
});


