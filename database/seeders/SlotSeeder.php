<?php

namespace Database\Seeders;

use App\Models\Slot;
use App\Models\Teacher;
use App\Models\Teaching;
use App\Models\AcademicPromotion;
use App\Models\Week;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifier si les dépendances existent
        if (Teacher::count() === 0) {
            $this->call(TeacherSeeder::class);
        }
        if (Teaching::count() === 0) {
            $this->call(TeachingSeeder::class);
        }
        if (AcademicPromotion::count() === 0) {
            $this->call(\Database\Seeders\PromotionSeeder::class);
        }
        if (Week::count() === 0) {
            $this->call(WeekSeeder::class);
        }

        $teacher = Teacher::first();
        $teaching = Teaching::first();
        $promotion = AcademicPromotion::first();
        $week = Week::first();
        $substituteTeacher = Teacher::skip(1)->first() ?? $teacher;

        Slot::create([
            'type' => 'CM',
            'duration' => 2,
            'teacher_id' => $teacher->id,
            'teaching_id' => $teaching->id,
            'substitute_teacher_id' => $substituteTeacher->id,
            'academic_promotion_id' => $promotion->id,
            'week_id' => $week->id,
        ]);
    }
}
