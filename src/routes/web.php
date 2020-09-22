<?php

use Agenciafmd\Admix\Http\Controllers\AdmixController;
use Agenciafmd\Admix\Http\Controllers\AuditController;
use Agenciafmd\Admix\Http\Controllers\Auth\ForgotPasswordController;
use Agenciafmd\Admix\Http\Controllers\Auth\LoginController;
use Agenciafmd\Admix\Http\Controllers\Auth\ResetPasswordController;
use Agenciafmd\Admix\Http\Controllers\ProfileController;
use Agenciafmd\Admix\Http\Controllers\RolesController;
use Agenciafmd\Admix\Http\Controllers\UsersController;
use Agenciafmd\Admix\Models\Audit;
use Agenciafmd\Admix\Models\User;

/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('admix.login.form')
    ->withoutMiddleware(['auth:admix-web']);;
Route::post('/login', [LoginController::class, 'login'])
    ->name('admix.login')
    ->withoutMiddleware(['auth:admix-web']);;
Route::get('/logout', [LoginController::class, 'logout'])
    ->name('admix.logout')
    ->withoutMiddleware(['auth:admix-web']);;
Route::get('/recover', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('admix.recover.form')
    ->withoutMiddleware(['auth:admix-web']);;
Route::post('/recover', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('admix.recover')
    ->withoutMiddleware(['auth:admix-web']);;
Route::get('/recover/reset/{token?}', [ResetPasswordController::class, 'showResetForm'])
    ->name('admix.recover.reset.form')
    ->withoutMiddleware(['auth:admix-web']);;
Route::post('/recover/reset', [ResetPasswordController::class, 'reset'])
    ->name('admix.recover.reset')
    ->withoutMiddleware(['auth:admix-web']);;

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

Route::get('users', [UsersController::class, 'index'])
    ->name('admix.users.index')
    ->middleware('can:view,' . User::class);
Route::get('users/trash', [UsersController::class, 'index'])
    ->name('admix.users.trash')
    ->middleware('can:restore,' . User::class);
Route::get('users/create', [UsersController::class, 'create'])
    ->name('admix.users.create')
    ->middleware('can:create,' . User::class);
Route::post('users', [UsersController::class, 'store'])
    ->name('admix.users.store')
    ->middleware('can:create,' . User::class);
Route::get('users/{user}', [UsersController::class, 'show'])
    ->name('admix.users.show')
    ->middleware('can:view,' . User::class);
Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('admix.users.edit')
    ->middleware('can:update,' . User::class);
Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('admix.users.update')
    ->middleware('can:update,' . User::class);
Route::delete('users/destroy/{user}', [UsersController::class, 'destroy'])
    ->name('admix.users.destroy')
    ->middleware('can:delete,' . User::class);
Route::post('users/{id}/restore', [UsersController::class, 'restore'])
    ->name('admix.users.restore')
    ->middleware('can:restore,' . User::class);
Route::post('users/batchDestroy', [UsersController::class, 'batchDestroy'])
    ->name('admix.users.batchDestroy')
    ->middleware('can:delete,' . User::class);
Route::post('users/batchRestore', [UsersController::class, 'batchRestore'])
    ->name('admix.users.batchRestore')
    ->middleware('can:restore,' . User::class);

/*
|--------------------------------------------------------------------------
| ROLES Routes
|--------------------------------------------------------------------------
*/

Route::get('roles', [RolesController::class, 'index'])
    ->name('admix.roles.index')
    ->middleware('can:view,\Agenciafmd\Admix\Role');
Route::get('roles/trash', [RolesController::class, 'index'])
    ->name('admix.roles.trash')
    ->middleware('can:restore,\Agenciafmd\Admix\Role');
Route::get('roles/create', [RolesController::class, 'create'])
    ->name('admix.roles.create')
    ->middleware('can:create,\Agenciafmd\Admix\Role');
Route::post('roles', [RolesController::class, 'store'])
    ->name('admix.roles.store')
    ->middleware('can:create,\Agenciafmd\Admix\Role');
Route::get('roles/{role}', [RolesController::class, 'show'])
    ->name('admix.roles.show')
    ->middleware('can:view,\Agenciafmd\Admix\Role');
Route::get('roles/{role}/edit', [RolesController::class, 'edit'])
    ->name('admix.roles.edit')
    ->middleware('can:update,\Agenciafmd\Admix\Role');
Route::put('roles/{role}', [RolesController::class, 'update'])
    ->name('admix.roles.update')
    ->middleware('can:update,\Agenciafmd\Admix\Role');
Route::delete('roles/destroy/{role}', [RolesController::class, 'destroy'])
    ->name('admix.roles.destroy')
    ->middleware('can:delete,\Agenciafmd\Admix\Role');
Route::post('roles/{id}/restore', [RolesController::class, 'restore'])
    ->name('admix.roles.restore')
    ->middleware('can:restore,\Agenciafmd\Admix\Role');
Route::post('roles/batchDestroy', [RolesController::class, 'batchDestroy'])
    ->name('admix.roles.batchDestroy')
    ->middleware('can:delete,\Agenciafmd\Admix\Role');
Route::post('roles/batchRestore', [RolesController::class, 'batchRestore'])
    ->name('admix.roles.batchRestore')
    ->middleware('can:restore,\Agenciafmd\Admix\Role');
