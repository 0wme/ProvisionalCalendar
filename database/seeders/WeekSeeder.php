<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Week;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Week::create([
            'name' => 'S1',
            'week_number' => 1,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S2',
            'week_number' => 2,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S3',
            'week_number' => 3,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S4',
            'week_number' => 4,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S5',
            'week_number' => 5,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S6',
            'week_number' => 6,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S7',
            'week_number' => 7,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S8',
            'week_number' => 8,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S9',
            'week_number' => 9,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S10',
            'week_number' => 10,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S11',
            'week_number' => 11,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S12',
            'week_number' => 12,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S13',
            'week_number' => 13,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S14',
            'week_number' => 14,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S15',
            'week_number' => 15,
            'year_id' => 1,
        ]);
        Week::create([
            'name' => 'S16',
            'week_number' => 16,
            'year_id' => 1,
        ]);
    }
}
