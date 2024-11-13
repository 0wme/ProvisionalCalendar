<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TeachingSeeder::class,
            TeacherTeachingSeeder::class,
            AcademicPromotionSeeder::class,
            AcademicGroupSeeder::class,
            AcademicSubgroupSeeder::class,
            YearSeeder::class,
            WeekSeeder::class,
            SlotSeeder::class,
        ]);
    }
} 