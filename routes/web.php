<?php

use Agenciafmd\Admix\Http\Livewire\Auth;
use Agenciafmd\Admix\Http\Livewire\Pages;
use Agenciafmd\Admix\Http\Middleware\Authenticate;
use Agenciafmd\Admix\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::withoutMiddleware([Authenticate::class . ':admix-web'])
    ->middleware([RedirectIfAuthenticated::class])
    ->group(function () {
        Route::redirect('/', '/login');
        Route::get('/login', Auth\Login::class)
            ->name('admix.auth.login');
        Route::get('/forgot-password', Auth\ForgotPassword::class)
            ->name('admix.auth.forgotPassword');
        Route::get('/reset-password/{token}', Auth\ResetPassword::class)
            ->name('admix.auth.resetPassword');
    });

Route::withoutMiddleware([Authenticate::class . ':admix-web'])
    ->group(function () {
        Route::post('/logout', Auth\Logout::class)
            ->name('admix.auth.logout');
    });

Route::get('/dashboard', Pages\Dashboard::class)
    ->name('admix.dashboard');
Route::get('/profile', Pages\Profile\MyAccount::class)
    ->name('admix.profile');
Route::get('/profile/change-password', Pages\Profile\ChangePassword::class)
    ->name('admix.profile.change-password');
Route::get('/users', Pages\User\Table::class)
    ->name('admix.user.index');
Route::get('/users/trash', Pages\User\Table::class)
    ->name('admix.user.trash');
Route::get('/users/create', Pages\User\Form::class)
    ->name('admix.user.create');
Route::get('/users/{user}/edit', Pages\User\Form::class)
    ->name('admix.user.edit');
