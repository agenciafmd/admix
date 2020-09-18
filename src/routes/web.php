<?php

use Agenciafmd\Admix\Http\Controllers\AdmixController;
use Agenciafmd\Admix\Http\Controllers\AuditController;
use Agenciafmd\Admix\Http\Controllers\Auth\ForgotPasswordController;
use Agenciafmd\Admix\Http\Controllers\Auth\LoginController;
use Agenciafmd\Admix\Http\Controllers\Auth\ResetPasswordController;
use Agenciafmd\Admix\Http\Controllers\ProfileController;
use Agenciafmd\Admix\Http\Controllers\RolesController;
use Agenciafmd\Admix\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url'))
    ->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])
            ->name('admix.login.form');
        Route::post('/login', [LoginController::class, 'login'])
            ->name('admix.login');
        Route::get('/logout', [LoginController::class, 'logout'])
            ->name('admix.logout');
        Route::get('/recover', [ForgotPasswordController::class, 'showLinkRequestForm'])
            ->name('admix.recover.form');
        Route::post('/recover', [ForgotPasswordController::class, 'sendResetLinkEmail'])
            ->name('admix.recover');
        Route::get('/recover/reset/{token?}', [ResetPasswordController::class, 'showResetForm'])
            ->name('admix.recover.reset.form');
        Route::post('/recover/reset', [ResetPasswordController::class, 'reset'])
            ->name('admix.recover.reset');
    });

/*
|--------------------------------------------------------------------------
| COMMON ADMIX Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url'))
    ->middleware(['auth:admix-web'])
    ->group(function () {
        Route::get('', [AdmixController::class, 'redirect'])
            ->name('admix.redirect');
        Route::get('dashboard', [AdmixController::class, 'dashboard'])
            ->name('admix.dashboard');
        Route::get('profile', [ProfileController::class, 'index'])
            ->name('admix.profile');
        Route::put('profile', [ProfileController::class, 'update'])
            ->name('admix.profile.update');
        Route::get('audit', [AuditController::class, 'index'])
            ->name('admix.audit.index')
            ->middleware('can:view,\Agenciafmd\Admix\Audit');
    });

/*
|--------------------------------------------------------------------------
| USERS Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url') . '/users')
    ->middleware(['auth:admix-web'])
    ->group(function () {
        Route::get('', [UsersController::class, 'index'])
            ->name('admix.users.index')
            ->middleware('can:view,\Agenciafmd\Admix\User');
        Route::get('trash', [UsersController::class, 'index'])
            ->name('admix.users.trash')
            ->middleware('can:restore,\Agenciafmd\Admix\User');
        Route::get('create', [UsersController::class, 'create'])
            ->name('admix.users.create')
            ->middleware('can:create,\Agenciafmd\Admix\User');
        Route::post('', [UsersController::class, 'store'])
            ->name('admix.users.store')
            ->middleware('can:create,\Agenciafmd\Admix\User');
        Route::get('{user}', [UsersController::class, 'show'])
            ->name('admix.users.show')
            ->middleware('can:view,\Agenciafmd\Admix\User');
        Route::get('{user}/edit', [UsersController::class, 'edit'])
            ->name('admix.users.edit')
            ->middleware('can:update,\Agenciafmd\Admix\User');
        Route::put('{user}', [UsersController::class, 'update'])
            ->name('admix.users.update')
            ->middleware('can:update,\Agenciafmd\Admix\User');
        Route::delete('destroy/{user}', [UsersController::class, 'destroy'])
            ->name('admix.users.destroy')
            ->middleware('can:delete,\Agenciafmd\Admix\User');
        Route::post('{id}/restore', [UsersController::class, 'restore'])
            ->name('admix.users.restore')
            ->middleware('can:restore,\Agenciafmd\Admix\User');
        Route::post('batchDestroy', [UsersController::class, 'batchDestroy'])
            ->name('admix.users.batchDestroy')
            ->middleware('can:delete,\Agenciafmd\Admix\User');
        Route::post('batchRestore', [UsersController::class, 'batchRestore'])
            ->name('admix.users.batchRestore')
            ->middleware('can:restore,\Agenciafmd\Admix\User');
    });

/*
|--------------------------------------------------------------------------
| ROLES Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url') . '/roles')
    ->middleware(['auth:admix-web'])
    ->group(function () {
        Route::get('', [RolesController::class, 'index'])
            ->name('admix.roles.index')
            ->middleware('can:view,\Agenciafmd\Admix\Role');
        Route::get('trash', [RolesController::class, 'index'])
            ->name('admix.roles.trash')
            ->middleware('can:restore,\Agenciafmd\Admix\Role');
        Route::get('create', [RolesController::class, 'create'])
            ->name('admix.roles.create')
            ->middleware('can:create,\Agenciafmd\Admix\Role');
        Route::post('', [RolesController::class, 'store'])
            ->name('admix.roles.store')
            ->middleware('can:create,\Agenciafmd\Admix\Role');
        Route::get('{role}', [RolesController::class, 'show'])
            ->name('admix.roles.show')
            ->middleware('can:view,\Agenciafmd\Admix\Role');
        Route::get('{role}/edit', [RolesController::class, 'edit'])
            ->name('admix.roles.edit')
            ->middleware('can:update,\Agenciafmd\Admix\Role');
        Route::put('{role}', [RolesController::class, 'update'])
            ->name('admix.roles.update')
            ->middleware('can:update,\Agenciafmd\Admix\Role');
        Route::delete('destroy/{role}', [RolesController::class, 'destroy'])
            ->name('admix.roles.destroy')
            ->middleware('can:delete,\Agenciafmd\Admix\Role');
        Route::post('{id}/restore', [RolesController::class, 'restore'])
            ->name('admix.roles.restore')
            ->middleware('can:restore,\Agenciafmd\Admix\Role');
        Route::post('batchDestroy', [RolesController::class, 'batchDestroy'])
            ->name('admix.roles.batchDestroy')
            ->middleware('can:delete,\Agenciafmd\Admix\Role');
        Route::post('batchRestore', [RolesController::class, 'batchRestore'])
            ->name('admix.roles.batchRestore')
            ->middleware('can:restore,\Agenciafmd\Admix\Role');
    });
