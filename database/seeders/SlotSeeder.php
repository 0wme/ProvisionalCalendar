<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slot::create([
            'duration' => 1.5,
            'teacher_id' => 1,
            'teaching_id' => 2,
            'substitute_teacher_id' => 3,
            'academic_promotion_id' => 2,
            'week_id' => 2,
        ]);
    }
}
