<?php

use Agenciafmd\Admix\Http\Controllers\AdmixController;
use Agenciafmd\Admix\Http\Controllers\AuditController;
use Agenciafmd\Admix\Http\Controllers\Auth\ForgotPasswordController;
use Agenciafmd\Admix\Http\Controllers\Auth\LoginController;
use Agenciafmd\Admix\Http\Controllers\Auth\ResetPasswordController;
use Agenciafmd\Admix\Http\Controllers\ProfileController;
use Agenciafmd\Admix\Http\Controllers\RoleController;
use Agenciafmd\Admix\Http\Controllers\UserController;
use Agenciafmd\Admix\Models\Audit;
use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;

/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('admix.login.form')
    ->withoutMiddleware(['auth:admix-web']);
Route::post('/login', [LoginController::class, 'login'])
    ->name('admix.login')
    ->withoutMiddleware(['auth:admix-web']);
Route::get('/logout', [LoginController::class, 'logout'])
    ->name('admix.logout')
    ->withoutMiddleware(['auth:admix-web']);
Route::get('/recover', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('admix.recover.form')
    ->withoutMiddleware(['auth:admix-web']);
Route::post('/recover', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('admix.recover')
    ->withoutMiddleware(['auth:admix-web']);
Route::get('/recover/reset/{token?}', [ResetPasswordController::class, 'showResetForm'])
    ->name('admix.recover.reset.form')
    ->withoutMiddleware(['auth:admix-web']);
Route::post('/recover/reset', [ResetPasswordController::class, 'reset'])
    ->name('admix.recover.reset')
    ->withoutMiddleware(['auth:admix-web']);

/*
|--------------------------------------------------------------------------
| COMMON ADMIX Routes
|--------------------------------------------------------------------------
*/

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
    ->middleware('can:view,' . Audit::class);

/*
|--------------------------------------------------------------------------
| USERS Routes
|--------------------------------------------------------------------------
*/

Route::get('users', [UserController::class, 'index'])
    ->name('admix.users.index')
    ->middleware('can:view,' . User::class);
Route::get('users/trash', [UserController::class, 'index'])
    ->name('admix.users.trash')
    ->middleware('can:restore,' . User::class);
Route::get('users/create', [UserController::class, 'create'])
    ->name('admix.users.create')
    ->middleware('can:create,' . User::class);
Route::post('users', [UserController::class, 'store'])
    ->name('admix.users.store')
    ->middleware('can:create,' . User::class);
Route::get('users/{user}', [UserController::class, 'show'])
    ->name('admix.users.show')
    ->middleware('can:view,' . User::class);
Route::get('users/{user}/edit', [UserController::class, 'edit'])
    ->name('admix.users.edit')
    ->middleware('can:update,' . User::class);
Route::put('users/{user}', [UserController::class, 'update'])
    ->name('admix.users.update')
    ->middleware('can:update,' . User::class);
Route::delete('users/destroy/{user}', [UserController::class, 'destroy'])
    ->name('admix.users.destroy')
    ->middleware('can:delete,' . User::class);
Route::post('users/{id}/restore', [UserController::class, 'restore'])
    ->name('admix.users.restore')
    ->middleware('can:restore,' . User::class);
Route::post('users/batchDestroy', [UserController::class, 'batchDestroy'])
    ->name('admix.users.batchDestroy')
    ->middleware('can:delete,' . User::class);
Route::post('users/batchRestore', [UserController::class, 'batchRestore'])
    ->name('admix.users.batchRestore')
    ->middleware('can:restore,' . User::class);

/*
|--------------------------------------------------------------------------
| ROLES Routes
|--------------------------------------------------------------------------
*/

Route::get('roles', [RoleController::class, 'index'])
    ->name('admix.roles.index')
    ->middleware('can:view' . Role::class);
Route::get('roles/trash', [RoleController::class, 'index'])
    ->name('admix.roles.trash')
    ->middleware('can:restore' . Role::class);
Route::get('roles/create', [RoleController::class, 'create'])
    ->name('admix.roles.create')
    ->middleware('can:create' . Role::class);
Route::post('roles', [RoleController::class, 'store'])
    ->name('admix.roles.store')
    ->middleware('can:create' . Role::class);
Route::get('roles/{role}', [RoleController::class, 'show'])
    ->name('admix.roles.show')
    ->middleware('can:view' . Role::class);
Route::get('roles/{role}/edit', [RoleController::class, 'edit'])
    ->name('admix.roles.edit')
    ->middleware('can:update' . Role::class);
Route::put('roles/{role}', [RoleController::class, 'update'])
    ->name('admix.roles.update')
    ->middleware('can:update' . Role::class);
Route::delete('roles/destroy/{role}', [RoleController::class, 'destroy'])
    ->name('admix.roles.destroy')
    ->middleware('can:delete' . Role::class);
Route::post('roles/{id}/restore', [RoleController::class, 'restore'])
    ->name('admix.roles.restore')
    ->middleware('can:restore' . Role::class);
Route::post('roles/batchDestroy', [RoleController::class, 'batchDestroy'])
    ->name('admix.roles.batchDestroy')
    ->middleware('can:delete' . Role::class);
Route::post('roles/batchRestore', [RoleController::class, 'batchRestore'])
    ->name('admix.roles.batchRestore')
    ->middleware('can:restore' . Role::class);
