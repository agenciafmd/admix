<?php

/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url'))
    ->group(function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')
            ->name('admix.login.form');
        Route::post('/login', 'Auth\LoginController@login')
            ->name('admix.login');
        Route::get('/logout', 'Auth\LoginController@logout')
            ->name('admix.logout');
        Route::get('/recover', 'Auth\ForgotPasswordController@showLinkRequestForm')
            ->name('admix.recover.form');
        Route::post('/recover', 'Auth\ForgotPasswordController@sendResetLinkEmail')
            ->name('admix.recover');
        Route::get('/recover/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')
            ->name('admix.recover.reset.form');
        Route::post('/recover/reset', 'Auth\ResetPasswordController@reset')
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
        Route::get('', 'AdmixController@redirect')
            ->name('admix.redirect');
        Route::get('dashboard', 'AdmixController@dashboard')
            ->name('admix.dashboard');
        Route::get('profile', 'ProfileController@index')
            ->name('admix.profile');
        Route::put('profile', 'ProfileController@update')
            ->name('admix.profile.update');
        Route::get('audit', 'AuditController@index')
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
        Route::get('', 'UsersController@index')
            ->name('admix.users.index')
            ->middleware('can:view,\Agenciafmd\Admix\User');
        Route::get('trash', 'UsersController@index')
            ->name('admix.users.trash')
            ->middleware('can:restore,\Agenciafmd\Admix\User');
        Route::get('create', 'UsersController@create')
            ->name('admix.users.create')
            ->middleware('can:create,\Agenciafmd\Admix\User');
        Route::post('', 'UsersController@store')
            ->name('admix.users.store')
            ->middleware('can:create,\Agenciafmd\Admix\User');
        Route::get('{user}', 'UsersController@show')
            ->name('admix.users.show')
            ->middleware('can:view,\Agenciafmd\Admix\User');
        Route::get('{user}/edit', 'UsersController@edit')
            ->name('admix.users.edit')
            ->middleware('can:update,\Agenciafmd\Admix\User');
        Route::put('{user}', 'UsersController@update')
            ->name('admix.users.update')
            ->middleware('can:update,\Agenciafmd\Admix\User');
        Route::delete('destroy/{user}', 'UsersController@destroy')
            ->name('admix.users.destroy')
            ->middleware('can:delete,\Agenciafmd\Admix\User');
        Route::post('{id}/restore', 'UsersController@restore')
            ->name('admix.users.restore')
            ->middleware('can:restore,\Agenciafmd\Admix\User');
        Route::post('batchDestroy', 'UsersController@batchDestroy')
            ->name('admix.users.batchDestroy')
            ->middleware('can:delete,\Agenciafmd\Admix\User');
        Route::post('batchRestore', 'UsersController@batchRestore')
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
        Route::get('', 'RolesController@index')
            ->name('admix.roles.index')
            ->middleware('can:view,\Agenciafmd\Admix\Role');
        Route::get('trash', 'RolesController@index')
            ->name('admix.roles.trash')
            ->middleware('can:restore,\Agenciafmd\Admix\Role');
        Route::get('create', 'RolesController@create')
            ->name('admix.roles.create')
            ->middleware('can:create,\Agenciafmd\Admix\Role');
        Route::post('', 'RolesController@store')
            ->name('admix.roles.store')
            ->middleware('can:create,\Agenciafmd\Admix\Role');
        Route::get('{role}', 'RolesController@show')
            ->name('admix.roles.show')
            ->middleware('can:view,\Agenciafmd\Admix\Role');
        Route::get('{role}/edit', 'RolesController@edit')
            ->name('admix.roles.edit')
            ->middleware('can:update,\Agenciafmd\Admix\Role');
        Route::put('{role}', 'RolesController@update')
            ->name('admix.roles.update')
            ->middleware('can:update,\Agenciafmd\Admix\Role');
        Route::delete('destroy/{role}', 'RolesController@destroy')
            ->name('admix.roles.destroy')
            ->middleware('can:delete,\Agenciafmd\Admix\Role');
        Route::post('{id}/restore', 'RolesController@restore')
            ->name('admix.roles.restore')
            ->middleware('can:restore,\Agenciafmd\Admix\Role');
        Route::post('batchDestroy', 'RolesController@batchDestroy')
            ->name('admix.roles.batchDestroy')
            ->middleware('can:delete,\Agenciafmd\Admix\Role');
        Route::post('batchRestore', 'RolesController@batchRestore')
            ->name('admix.roles.batchRestore')
            ->middleware('can:restore,\Agenciafmd\Admix\Role');
    });
