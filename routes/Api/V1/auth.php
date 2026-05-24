<?php

use App\Http\Controllers\Api\V1\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use \App\Http\Controllers\Api\V1\Auth\PasswordResetLinkController;
use \App\Http\Controllers\Api\V1\Auth\NewPasswordController;
use App\Http\Controllers\Api\V1\Auth\VerifyEmailController;
use Inertia\Inertia;

Route::prefix('v1')
    ->name('v1.')
    ->group(function () {
        Route::prefix('auth')
            ->name('auth.')
            ->group(function () {
                Route::post('register', [RegisterController::class, 'register'])
                    ->name('register');
                Route::post('login', [LoginController::class, 'authenticate'])->name('login');
                Route::post('password/email', [PasswordResetLinkController::class, 'sendResetLinkEmail'])->name('password.email');
                Route::post('password/new-password', [NewPasswordController::class, 'store'])->name('password.store');
            });


    });

Route::get('login', [LoginController::class, 'loginPage'])
    ->middleware('guest')
    ->name('login');
Route::get('register', [RegisterController::class, 'registerPage'])->name('register');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('password-reset', [PasswordResetLinkController::class,'forgotPasswordPage'])->name('password.request');
Route::get('password-reset/{token}', [NewPasswordController::class,'newPasswordPage'])->name('password.reset');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/email/verify', function () {
    return Inertia::render('Auth/VerifyEmail');
})->name('verification.notice');
