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

        $user = new User();
        $user->name = "User";
        $user->last_name = "Test";
        $user->email = "3liuhernandez@gmail.com";
        $user->password = bcrypt("mints");
        $user->status = 1;
        $user->save();
    }
}
