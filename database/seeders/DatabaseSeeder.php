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
            YearSeeder::class,
            WeekSeeder::class,
            AcademicPromotionSeeder::class,
            AcademicGroupSeeder::class,
            AcademicSubgroupSeeder::class,
            AlertSeeder::class,
            TeachingSeeder::class,
            TeacherSeeder::class,
            TeacherTeachingSeeder::class,
            SlotSeeder::class,
        ]);
    }
} 