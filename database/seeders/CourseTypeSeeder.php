<?php

namespace Database\Seeders;

use App\Models\CourseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr_types = [
            [
                'title' => "bíblico",
            ],
            [
                'title' => "teológico",
            ],
            [
                'title' => "complementario",
            ],
        ];

        $code = 1;
        foreach ($arr_types as $key => $value) {
            $value = (object) $value;
            $status = new CourseType();
            $status->code = $code;
            $status->title = $value->title;
            $status->save();
            $code++;
        }
    }
}
