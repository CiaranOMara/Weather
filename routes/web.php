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

Auth::routes(['verify' => true]);

Route::get('password/set', 'Auth\RegisterController@showSetPasswordForm')->name('password.set')->middleware('logout', 'guest');
Route::post('password/set', 'Auth\RegisterController@setPassword')->name('password.set.post')->middleware('guest');

Route::get('confirm/{token}', ['as' => 'auth.confirm', 'uses' => 'Auth\RegisterController@confirmEmail'])->middleware('logout', 'guest');


Route::group(['middleware' => ['auth']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    Route::post('triggers/{trigger}/users', 'TriggerController@attachUser')->name('triggers.users.store');
    Route::delete('triggers/{trigger}/users/{user}', 'TriggerController@detachUser')->name('triggers.users.destroy');
    Route::resource('triggers', 'TriggerController');

    Route::match(['get', 'patch'], 'notifications/{notification}', 'NotificationController@markAsRead')->name('notifications.read')->middleware('auth');
    Route::match(['get', 'patch'], 'notifications', 'NotificationController@markAllAsRead')->name('notifications.all')->middleware('auth');
});

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