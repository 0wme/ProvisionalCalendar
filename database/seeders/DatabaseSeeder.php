<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            YearSeeder::class,
            WeekSeeder::class,
            AcademicPromotionSeeder::class,
            AcademicGroupSeeder::class,
            AcademicSubgroupSeeder::class,
            AlertSeeder::class,
            SemesterSeeder::class,
            TrimesterSeeder::class,
            TeachingSeeder::class,
            TeacherSeeder::class,
            TeacherTeachingSeeder::class,
            SlotSeeder::class,
            LabelsSeeder::class,
        ]);
    }
} 