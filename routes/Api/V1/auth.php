<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;

Route::prefix('v1')
    ->name('v1.')
    ->group(function () {
        Route::prefix('auth')
            ->name('auth.')
            ->group(function () {
                Route::post('register', [RegisterController::class, 'register'])
                    ->name('register');
                Route::post('login', [LoginController::class, 'authenticate'])->name('login');
            });
    });

Route::get('login', [LoginController::class, 'loginPage'])->name('login');
Route::get('register', [RegisterController::class, 'registerPage'])->name('register');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
