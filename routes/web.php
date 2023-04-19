<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\OrderController;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    // return view('welcome');
    return redirect('//localhost:5174/');
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

Route::get('/payment-success', function () {
    return view('payment_success');
})->name('payment-success');

//----------------------------------------------------------------------
// PAYMENT ROUTES - Front End
Route::get('/payments', function (Order $order) {

    $allOrders = Order::orderBy('id', 'DESC')->get();
    $order = $allOrders['0'];

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey'),
    ]);

    $token = $gateway->ClientToken()->generate();
    return view('payment_form', [
        'token' => $token
    ], compact('order'));
})->name('payments');

//PAYMENT - Back End (effectibe payment in post)
Route::post('/checkout', function (Request $request) {

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey'),
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;
        //header("Location: transaction.php?id=" . $transaction->id);

        // return back()->with('success_message', 'Transazione avvenuta con successo. Il tuo ID acquirente è: ' . $transaction->id);
        return to_route('payment-success');
    } else {
        $errorString = "";
        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ': ' . $error->message . '\n';
        }

        //$_SESSION["errors"] = $errorString;
        //header("Location: index.php");

        return back()->withErrors('An error occured with message: ' . $result->message);
    }
});

//----------------------------------------------------------------------



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
