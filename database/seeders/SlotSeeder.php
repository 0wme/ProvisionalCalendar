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
        // Slots CM pour atteindre 20h
        for($i = 0; $i < 14; $i++) {
            Slot::create([
                'duration' => 1.5,
                'teacher_id' => 1,
                'teaching_id' => 2,
                'substitute_teacher_id' => 3,
                'academic_promotion_id' => 1,
                'week_id' => 2,
                'type' => 'CM',
            ]);
        }

        // Slots TD pour atteindre 15h
        for($i = 0; $i < 10; $i++) {
            Slot::create([
                'duration' => 1.5,
                'teacher_id' => 1,
                'teaching_id' => 2,
                'substitute_teacher_id' => 3,
                'academic_promotion_id' => 1,
                'week_id' => 2,
                'type' => 'TD',
            ]);
        }

        // Slots TP pour atteindre 15h
        for($i = 0; $i < 10; $i++) {
            Slot::create([
                'duration' => 1.5,
                'teacher_id' => 1,
                'teaching_id' => 2,
                'substitute_teacher_id' => 3,
                'academic_promotion_id' => 1,
                'week_id' => 2,
                'type' => 'TP',
            ]);
        }
    }
}
