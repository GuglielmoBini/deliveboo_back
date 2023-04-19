<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Dish;
use App\Models\DishOrder;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        //taking every dishes of each order
        $orders = Order::orderBy('updated_at', 'DESC')->with('dishes')->simplePaginate(10);
        */

        /*
        //taking specific restaurant id
        $user_restaurant = DB::table('restaurants')->where('user_id', '=', $userId);

        $user_dishes = DB::table('dishes')->where('restaurant_id', '=', $user_restaurant);
        dd($user_dishes);
        */


        //taking each user by id
        $userId = Auth::user()->id;

        //taking each restaurant
        $restaurants = Restaurant::all();

        //taking specific user
        $user_restaurant = null;
        foreach ($restaurants as $restaurant) {
            if ($restaurant->user_id == $userId) {
                $user_restaurant = $restaurant;
            }
        }

        //taking each dish
        $dishes = Dish::All();

        //taking each order of every dish
        $dishes_orders = DishOrder::All();


        $user_dishes = [];
        $user_dish_orders = [];
        foreach ($dishes as $dish) {
            if ($dish->restaurant_id == $user_restaurant->id) {
                $user_dishes[] = $dish;
            }
        }

        foreach ($user_dishes as $user_dish) {
            foreach ($dishes_orders as $dish_order) {
                if ($dish_order->dish_id == $user_dish->id) {
                    $user_dish_orders[] = $dish_order;
                }
            }
        }

        //taking each order
        $orders = Order::All();

        $user_orders = [];
        foreach ($orders as $order) {
            foreach ($user_dish_orders as $user_dish_order) {
                if ($user_dish_order->order_id == $order->id) {
                    if ($user_orders == []) {
                        $user_orders[] = $order;
                    } elseif ($user_orders[count($user_orders) - 1]['id'] !== $order->id) {
                        $user_orders[] = $order;
                    }
                }
            }
            //  && $user_orders[count($user_orders) - 1]
        }

        return view('admin.orders.index', compact('user_orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
