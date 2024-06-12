<?php

use App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin;


Route::get('/', [HomeController::class, 'index']);

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
