<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\StockOrderController;
use App\Http\Controllers\StockSaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AutomationController;
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
Route::apiResource('dropdowns', DropdownController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('sales', SaleController::class);
Route::apiResource('stockitems', StockItemController::class);
Route::apiResource('stockorders', StockOrderController::class);
Route::apiResource('stocksales', StockSaleController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('automation', AutomationController::class);

//custom API routes
Route::get('dropdown_group/{dropdown_group}', [DropdownController::class, 'getDropdownByDropdownGroup']);
Route::post('orders/fulfill_order/{order}', [OrderController::class, 'fulfillOrder']);
Route::get('order_dropdown', [OrderController::class, 'orderDropdown']);
Route::get('stock_dropdown', [StockItemController::class, 'stockDropdown']);
Route::get('supplier_dropdown', [SupplierController::class, 'supplierDropdown']);
Route::get('email', [MailController::class, 'sendMail']);