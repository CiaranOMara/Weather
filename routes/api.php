<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('humidity', function () {
    return \App\Humidity::last24Hours()->orderBy('created_at', 'asc')->get();
});

Route::get('temperature', function () {
    return \App\Temperature::last24Hours()->orderBy('created_at', 'asc')->get();
});