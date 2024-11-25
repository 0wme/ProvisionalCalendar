<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trimester;

class TrimesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trimester::create([
            'trimester_number' => 1,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimester_number' => 2,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimester_number' => 3,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimester_number' => 4,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimester_number' => 5,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimester_number' => 6,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimester_number' => 7,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimester_number' => 8,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimester_number' => 9,
            'year_id' => 1
        ]);
    }
}
