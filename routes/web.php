<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('password/set', 'Auth\RegisterController@showSetPasswordForm')->name('password.set')->middleware('logout', 'guest');
Route::post('password/set', 'Auth\RegisterController@setPassword')->name('password.set.post')->middleware('guest');

Route::get('confirm/{token}', ['as' => 'auth.confirm', 'uses' => 'Auth\RegisterController@confirmEmail'])->middleware('logout', 'guest');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {

    # Permissions
    Route::resource('permissions', 'PermissionController');

    # Roles
    Route::post('roles/{role}/permissions', 'RoleController@attachPermission')->name('roles.permissions.store');
    Route::delete('roles/{role}/permissions/{permission}', 'RoleController@detachPermission')->name('roles.permissions.destroy');
    Route::resource('roles', 'RoleController');

    # Users
    Route::post('users/{user}/permissions', 'UserController@attachPermission')->name('users.permissions.store');
    Route::delete('users/{user}/permissions/{permission}', 'UserController@detachPermission')->name('users.permissions.destroy');
    Route::post('users/{user}/roles', 'UserController@attachRole')->name('users.roles.store');
    Route::delete('users/{user}/roles/{role}', 'UserController@detachRole')->name('users.roles.destroy');
    Route::resource('users', 'UserController');
});