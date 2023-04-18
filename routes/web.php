<?php

use Agenciafmd\Admix\Http\Livewire\Auth;
use Agenciafmd\Admix\Http\Livewire\Dashboard;
use Agenciafmd\Admix\Http\Middleware\Authenticate;
use Agenciafmd\Admix\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::withoutMiddleware([Authenticate::class . ':admix-web'])
    ->middleware([RedirectIfAuthenticated::class])
    ->group(function () {
        Route::get('/login', Auth\Login::class)
            ->name('admix.auth.login');
        Route::get('/forgot-password', Auth\ForgotPassword::class)
            ->name('admix.auth.forgotPassword');
        Route::get('/reset-password/{token}', Auth\ResetPassword::class)
            ->name('admix.auth.resetPassword');
    });

Route::withoutMiddleware([Authenticate::class . ':admix-web'])
    ->group(function () {
        Route::get('/logout', Auth\Logout::class)
            ->name('admix.auth.logout');
    });

Route::get('/dashboard', Dashboard::class)
    ->name('admix.dashboard');
