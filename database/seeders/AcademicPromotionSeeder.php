<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcademicPromotion;

class AcademicPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicPromotion::create([
            'name' => 'BUT1'
        ]);
        AcademicPromotion::create([
            'name' => 'BUT2'
        ]);
        AcademicPromotion::create([
            'name' => 'BUT3'
        ]);
    }
}
