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
        for ($i = 1; $i < 6; $i++) {
            $restaurant = new Restaurant();
            $restaurant->user_id = $i;
            $restaurant->address = 'Via Mattei 15';
            $restaurant->name = 'Burger Queen';
            $restaurant->save();
        }
    }
}