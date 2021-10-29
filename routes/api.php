<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanTypeController;
use App\Http\Controllers\ActivityController;

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

Route::post('add_plan',[PlanTypeController::class,'create_plan_type']);
Route::get('list_plans',[PlanTypeController::class,'list_plans']);
Route::get('plan_type/{id}',[PlanTypeController::class,'show_plan']);
Route::put('update_plan/{id}',[PlanTypeController::class,'update_plan']);
Route::delete('delete_plan/{id}',[PlanTypeController::class,'destroy_plan']);

Route::post('add_activity',[ActivityController::class,'create_activity']);
Route::get('list_activities',[ActivityController::class,'list_activities']);
Route::get('activity/{id}',[ActivityController::class,'show_activity']);
Route::put('update_activity/{id}',[ActivityController::class,'update_activity']);
Route::delete('delete_activity/{id}',[ActivityController::class,'destroy_activity']);