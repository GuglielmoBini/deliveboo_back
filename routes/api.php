<?php

use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API for Dishes
Route::apiResource('dishes', DishController::class);
// API for Orders
//Route::apiResource('orders', OrderController::class);
// API for Restaurants
Route::apiResource('restaurants', RestaurantController::class);
// API for Types
Route::apiResource('types', TypeController::class);


Route::post('orders/store', [OrderController::class, 'store']);
