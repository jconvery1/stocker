<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserController;

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

//sign in routes
Route::get('/sign-in', [UserController::class, 'signInScreen'])->name('sign-in');
Route::post('/sign-in', [UserController::class, 'signIn'])->name('sign-in');
Route::get('/sign-out', [UserController::class, 'signOut'])->name('sign-out');
Route::get('/create-account', [CustomAuthController::class, 'create']);
Route::post('/create-account', [UserController::class, 'store'])->name('create-account');

Route::get('/{any?}', function () {
    return view('app');
})->middleware('auth');
