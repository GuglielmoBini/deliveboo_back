<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_restaurants = config('restaurants');
        foreach ($all_restaurants as $restaurant) {
            $new_restaurant = new Restaurant();
            $new_restaurant->user_id = $restaurant['user_id'];
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->description = $restaurant['description'];
            $new_restaurant->image = $restaurant['image'];
            $new_restaurant->save();
        }
    }
}
