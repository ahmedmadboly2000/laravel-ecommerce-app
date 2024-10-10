<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
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
Route::get('products/{product}/current-price', [ProductController::class, 'currentPrice']);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::get('products/{product}/current-price', [ProductController::class, 'currentPrice']);
Route::apiResource('prices', PriceController::class);
Route::apiResource('orders', OrderController::class);
