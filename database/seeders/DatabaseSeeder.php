<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Création des rôles et de l'année universitaire en premier
        $this->call([
            RoleSeeder::class,
            YearSeeder::class,
            SemesterSeeder::class,
            TrimesterSeeder::class,
        ]);

        // 2. Création des utilisateurs
        $this->call(UserSeeder::class);

        // 4. Création des autres données
        $this->call([
            WeekSeeder::class,
            TeacherSeeder::class,
            TeachingSeeder::class,
            TeacherTeachingSeeder::class,
        ]);
    }
} 