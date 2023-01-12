<?php

use App\Http\Controllers\UserController;
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

Route::apiResource('users', UserController::class);
Route::apiResource('customers', UserController::class);
Route::apiResource('deliveries', UserController::class);
Route::apiResource('orders', UserController::class);
Route::apiResource('sales', UserController::class);
Route::apiResource('stockitems', UserController::class);
Route::apiResource('stockorders', UserController::class);
Route::apiResource('stocksales', UserController::class);
Route::apiResource('suppliers', UserController::class);