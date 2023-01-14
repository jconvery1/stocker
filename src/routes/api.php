<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\StockOrderController;
use App\Http\Controllers\StockSaleController;
use App\Http\Controllers\SupplierController;
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
Route::apiResource('customers', CustomerController::class);
Route::apiResource('deliveries', DeliveryController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('sales', SaleController::class);
Route::apiResource('stockitems', StockItemController::class);
Route::apiResource('stockorders', StockOrderController::class);
Route::apiResource('stocksales', StockSaleController::class);
Route::apiResource('suppliers', SupplierController::class);