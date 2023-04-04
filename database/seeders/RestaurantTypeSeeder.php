<?php

namespace Database\Seeders;

use App\Models\RestaurantType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $all_restaurants_types = config('restaurant_type');
        foreach ($all_restaurants_types as $restaurant_type) {
            $new_restaurant_type = new RestaurantType();
            $new_restaurant_type->restaurant_id = $restaurant_type['restaurant_id'];
            $new_restaurant_type->type_id = $restaurant_type['type_id'];
            $new_restaurant_type->save();
        }
    }
}
