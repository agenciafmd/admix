<?php

use Agenciafmd\Admix\Http\Middleware\Authenticate;
use Agenciafmd\Admix\Http\Middleware\RedirectIfAuthenticated;
use Agenciafmd\Admix\Livewire\Auth;
use Agenciafmd\Admix\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::withoutMiddleware([Authenticate::class . ':admix-web'])
    ->middleware([RedirectIfAuthenticated::class])
    ->group(function () {
        Route::redirect('/', config('admix.path') . '/login');
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

Route::get('/users', Pages\User\Index::class)
    ->name('admix.users.index');
Route::get('/users/trash', Pages\User\Index::class)
    ->name('admix.users.trash');
Route::get('/users/create', Pages\User\Component::class)
    ->name('admix.users.create');
Route::get('/users/{user}/edit', Pages\User\Component::class)
    ->name('admix.users.edit');

Route::get('/roles', Pages\Role\Index::class)
    ->name('admix.roles.index');
Route::get('/roles/trash', Pages\Role\Index::class)
    ->name('admix.roles.trash');
Route::get('/roles/create', Pages\Role\Component::class)
    ->name('admix.roles.create');
Route::get('/roles/{role}/edit', Pages\Role\Component::class)
    ->name('admix.roles.edit');

Route::get('/audit', Pages\Audit\Index::class)
    ->name('admix.audit.index');
