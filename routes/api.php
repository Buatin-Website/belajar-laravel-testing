<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::apiResource('users', 'UserController')->middleware(['role:Administrator']);
});