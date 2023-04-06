<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\OrderController;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $restaurants = Restaurant::All();

    
    foreach ($restaurants as $restaurant) {
        if ($restaurant->user_id == Auth::user()->id) {

            $res = $restaurant;
            return view('dashboard', compact('res'));
            
        }
    }

    return to_route('admin.restaurants.create');

})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
    // Code below groups all the CRUD's routes
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('dishes', DishController::class);
    Route::resource('types', TypeController::class);
    Route::resource('orders', OrderController::class);

    // toggle route
    Route::patch('/dishes/{dish}/toggle', [DishController::class, 'toggle'])->name('dishes.toggle');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
