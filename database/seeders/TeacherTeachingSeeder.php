<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\Teaching;
use Illuminate\Database\Seeder;

class TeacherTeachingSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = Teacher::where('acronym', 'LD')->first();
        $teaching = Teaching::first();
        $teacher->teachings()->attach($teaching);
    }
}
