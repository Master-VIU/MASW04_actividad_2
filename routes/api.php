<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserStaffController;
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

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(ShoppingCartController::class)->prefix('cart')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});


Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

/*
Route::controller(PersonController::class)->prefix('person')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(UserStaffController::class)->prefix('userstaff')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});


Route::controller(AddressController::class)->prefix('address')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});
*/
