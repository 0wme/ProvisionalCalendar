<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Semester::create([
            'semester_number' => 1,
            'year_id' => 1
        ]);

        Semester::create([
            'semester_number' => 2,
            'year_id' => 1
        ]);

        Semester::create([
            'semester_number' => 3,
            'year_id' => 1
        ]);

        Semester::create([
            'semester_number' => 4,
            'year_id' => 1
        ]);

        Semester::create([
            'semester_number' => 5,
            'year_id' => 1
        ]);

        Semester::create([
            'semester_number' => 6,
            'year_id' => 1
        ]);
    }
}
