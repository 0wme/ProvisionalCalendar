<?php

namespace Database\Seeders\Groups;

use Illuminate\Database\Seeder;
use App\Models\Groups\Promotion;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Promotion::create([
            'name' => 'BUT1',
            'year_id' => 1,
        ]);
        Promotion::create([
            'name' => 'BUT2',
            'year_id' => 1,
        ]);
        Promotion::create([
            'name' => 'BUT3',
            'year_id' => 1,
        ]);
    }
}
