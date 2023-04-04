<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_orders = config('orders');
        foreach ($all_orders as $order) {
            $new_order = new Order();
            $new_order->delivery_address = $order['delivery_address'];
            $new_order->customer_name = $order['customer_name'];
            $new_order->customer_surname = $order['customer_surname'];
            $new_order->customer_phone_number = $order['customer_phone_number'];
            $new_order->customer_email = $order['customer_email'];
            $new_order->total_price = $order['total_price'];
            $new_order->is_paid = $order['is_paid'];
            $new_order->save();
        }
    }
}
