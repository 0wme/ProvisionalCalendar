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
            'trimestre_number' => 1,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimestre_number' => 2,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimestre_number' => 3,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimestre_number' => 4,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimestre_number' => 5,
            'year_id' => 1
        ]);

        Trimester::create([
            'trimestre_number' => 6,
            'year_id' => 1
        ]);
    }
}
