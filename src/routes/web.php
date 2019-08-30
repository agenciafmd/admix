<?php

/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url'))->name('admix.')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/recover', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('recover.form');
    Route::post('/recover', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('recover');
    Route::get('/recover/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('recover.reset.form');
    Route::post('/recover/reset', 'Auth\ResetPasswordController@reset')->name('recover.reset');
});

/*
|--------------------------------------------------------------------------
| COMMON ADMIX Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url'))->name('admix.')->middleware(['auth:admix-web'])->group(function () {
    Route::get('', 'AdmixController@redirect')->name('redirect');
    Route::get('dashboard', 'AdmixController@dashboard')->name('dashboard');
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
//    Route::get('notification', 'NotificationController@index')->name('notification');
//    Route::post('notification', 'NotificationController@update')->name('notification.post');
    Route::get('audit', 'AuditController@index')->name('audit.index')->middleware('can:view,\Agenciafmd\Admix\Audit');

    Route::post('upload', 'UploadController@index')->name('upload.index');
    Route::post('destroy', 'UploadController@destroy')->name('upload.destroy');
    Route::get('meta/{uuid}', 'UploadController@metaForm')->name('upload.meta');
    Route::post('meta/{uuid}', 'UploadController@metaPost')->name('upload.meta.post');
#    Route::post('sort', 'UploadController@sort')->name('upload.sort');
    Route::post('medium', 'UploadController@medium')->name('upload.medium');
});

// resize route
Route::get('/media/{path}', 'MediaController@show')->name('media.show')->where('path', '.*');

/*
|--------------------------------------------------------------------------
| USERS Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url') . '/users')->name('admix.users.')->middleware(['auth:admix-web'])->group(function () {
    Route::get('', 'UsersController@index')->name('index')->middleware('can:view,\Agenciafmd\Admix\User');
    Route::get('trash', 'UsersController@index')->name('trash')->middleware('can:restore,\Agenciafmd\Admix\User');
    Route::get('create', 'UsersController@create')->name('create')->middleware('can:create,\Agenciafmd\Admix\User');
    Route::post('', 'UsersController@store')->name('store')->middleware('can:create,\Agenciafmd\Admix\User');
    Route::get('{user}', 'UsersController@show')->name('show')->middleware('can:view,\Agenciafmd\Admix\User');
    Route::get('{user}/edit', 'UsersController@edit')->name('edit')->middleware('can:update,\Agenciafmd\Admix\User');
    Route::put('{user}', 'UsersController@update')->name('update')->middleware('can:update,\Agenciafmd\Admix\User');
    Route::delete('destroy/{user}', 'UsersController@destroy')->name('destroy')->middleware('can:delete,\Agenciafmd\Admix\User');
    Route::post('{id}/restore', 'UsersController@restore')->name('restore')->middleware('can:restore,\Agenciafmd\Admix\User');
    Route::post('batchDestroy', 'UsersController@batchDestroy')->name('batchDestroy')->middleware('can:delete,\Agenciafmd\Admix\User');
    Route::post('batchRestore', 'UsersController@batchRestore')->name('batchRestore')->middleware('can:restore,\Agenciafmd\Admix\User');
});

/*
|--------------------------------------------------------------------------
| ROLES Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url') . '/roles')->name('admix.roles.')->middleware(['auth:admix-web'])->group(function () {
    Route::get('', 'RolesController@index')->name('index')->middleware('can:view,\Agenciafmd\Admix\Role');
    Route::get('trash', 'RolesController@index')->name('trash')->middleware('can:restore,\Agenciafmd\Admix\Role');
    Route::get('create', 'RolesController@create')->name('create')->middleware('can:create,\Agenciafmd\Admix\Role');
    Route::post('', 'RolesController@store')->name('store')->middleware('can:create,\Agenciafmd\Admix\Role');
    Route::get('{role}', 'RolesController@show')->name('show')->middleware('can:view,\Agenciafmd\Admix\Role');
    Route::get('{role}/edit', 'RolesController@edit')->name('edit')->middleware('can:update,\Agenciafmd\Admix\Role');
    Route::put('{role}', 'RolesController@update')->name('update')->middleware('can:update,\Agenciafmd\Admix\Role');
    Route::delete('destroy/{role}', 'RolesController@destroy')->name('destroy')->middleware('can:delete,\Agenciafmd\Admix\Role');
    Route::post('{id}/restore', 'RolesController@restore')->name('restore')->middleware('can:restore,\Agenciafmd\Admix\Role');
    Route::post('batchDestroy', 'RolesController@batchDestroy')->name('batchDestroy')->middleware('can:delete,\Agenciafmd\Admix\Role');
    Route::post('batchRestore', 'RolesController@batchRestore')->name('batchRestore')->middleware('can:restore,\Agenciafmd\Admix\Role');
});
