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

//////////////////////////USER ROUTES////////////////////

Route::group(['prefix' => 'users'], function() {

Route::post('/register', ['App\Http\Controllers\UserController', 'register']);
Route::post('/login', ['App\Http\Controllers\UserController', 'login']);

Route::group(['middleware' => ['jwt.user']], function() {
    Route::post('/logout', ['App\Http\Controllers\UserController', 'logout']);
});
});


//////////////////////////ADMIN ROUTES////////////////////

Route::group(['prefix' => 'admins'], function() {

    Route::post('/register', ['App\Http\Controllers\AdminController', 'register']);
    Route::post('/login', ['App\Http\Controllers\AdminController', 'login']);

    Route::group(['middleware' => ['jwt.admin']], function() {
        Route::post('/logout', ['App\Http\Controllers\AdminController', 'logout']);
        Route::get('/index', ['App\Http\Controllers\AdminController', 'index']);

    });
});
