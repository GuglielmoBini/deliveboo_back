<?php

namespace Database\Seeders;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_types = config('types');
        foreach ($all_types as $type) {
            $new_type = new Type();
            $new_type->name = $type['name'];    
            $new_type->image = $type['image'];
            $new_type->save();    
        }
    }
}
