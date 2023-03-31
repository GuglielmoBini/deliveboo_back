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
        $emails = ['1@h.it', '2@h.it', '3@h.it', '4@h.it', '5@h.it'];
        $numbers = ['12345678986', '12345678980', '12345678981', '12345678982', '12345678983'];


        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->name = 'Guglielmo';
            $user->surname = 'Bini';
            $user->vat_number = $numbers[$i];
            $user->email = $emails[$i];
            $user->password = 'password';
            $user->save();
        }
    }
}
