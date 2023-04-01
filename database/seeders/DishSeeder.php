<?php

namespace Database\Seeders;
use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        $all_dishes = config('dishes');
        foreach($all_dishes as $dish){
            $new_dish = new Dish();
            $new_dish->restaurant_id=$dish['restaurant_id'];
            $new_dish->name = $dish['name'];
            if(Arr::exists($dish, 'description')){
                $new_dish->description = $dish['description'];   
            }
            if(Arr::exists($dish, 'image')){
                $new_dish->image = $dish['image'];   
            }
            $new_dish->price = $dish['price'];
            $new_dish->is_visible = $dish['is_visible'];
            $new_dish->save();

        }
    }
}
