<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr_status = [
            [
                'title' => "pastor",
            ],
            [
                'title' => "admin",
            ],
            [
                'title' => "student",
            ],
            [
                'title' => "teacher",
            ],
            [
                'title' => "developer",
            ],
        ];

        $code = 1;
        foreach ($arr_status as $key => $value) {
            $value = (object) $value;
            $status = new UserType();
            $status->code = $code;
            $status->title = $value->title;
            $status->save();
            $code++;
        }
    }
}
