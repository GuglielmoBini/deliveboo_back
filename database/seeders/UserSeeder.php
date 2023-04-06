<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        $all_users = config('users');
        foreach ($all_users as $user) {
            $new_user = new User();
            $new_user->name = $user['name'];
            $new_user->surname = $user['surname'];
            $new_user->vat_number = $user['vat_number'];
            $new_user->email =  $user['email'];
            $new_user->password =  bcrypt($user['password']);
            $new_user->save();
        }
    }
}
