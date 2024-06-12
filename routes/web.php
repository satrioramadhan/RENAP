<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin;


Route::get('/', [HomeController::class, 'index']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware(['signed']);


Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'is_admin'])->group(function() {
    Route::get('dashboard', Admin\DashboardController::class)->name('dashboard');
    Route::resource('accommodations', Admin\AccommodationController::class);
    Route::resource('users', Admin\UserController::class);
    Route::put('/users/{user}/toggle-admin', [Admin\UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
});

