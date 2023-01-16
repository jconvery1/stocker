<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/deliveries', 'App\Http\Controllers\DeliveryController@index');
Route::get('/sales', 'App\Http\Controllers\SaleController@index');
Route::get('/orders', 'App\Http\Controllers\OrderController@index');
Route::get('/stockitems', 'App\Http\Controllers\StockItemController@index');
Route::post('/stockitems', 'App\Http\Controllers\StockItemController@store');
Route::get('/users', 'App\Http\Controllers\UserController@index');

Route::get('/{any?}', function () {
    return view('app');
});