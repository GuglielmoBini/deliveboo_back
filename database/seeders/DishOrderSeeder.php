<?php

namespace Database\Seeders;

use App\Models\DishOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_deishes_orders = config('dish_order');
        foreach ($all_deishes_orders as $dish_order) {
            $new_dish_order = new DishOrder();
            $new_dish_order->dish_id = $dish_order['dish_id'];
            $new_dish_order->order_id = $dish_order['order_id'];
            $new_dish_order->amount = $dish_order['amount'];
            $new_dish_order->save();
        }
    }
}
