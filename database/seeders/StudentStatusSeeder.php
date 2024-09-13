<?php

namespace Database\Seeders;

use App\Models\StudentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr_status = [
            [
                'title' => "activo",
            ],
            [
                'title' => "inactivo",
            ],
            [
                'title' => "suspendido",
            ],
        ];

        $code = 1;
        foreach ($arr_status as $key => $value) {
            $value = (object) $value;
            $status = new StudentStatus();
            $status->code = $code;
            $status->title = $value->title;
            $status->save();
            $code++;
        }
    }
}
