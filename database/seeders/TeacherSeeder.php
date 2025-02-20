<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Year;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifier si l'utilisateur existe
        $user = User::first();

        if (!$user) {
            // Si pas d'utilisateur, on lance d'abord le UserSeeder
            $this->call(UserSeeder::class);
            $user = User::first();
        }

        // Vérifier si l'année existe
        $year = Year::first();

        if (!$year) {
            // Si pas d'année, on lance d'abord le YearSeeder
            $this->call(YearSeeder::class);
            $year = Year::first();
        }

        // Créer l'enseignant
        Teacher::create([
            'user_id' => 4,
            'year_id' => $year->id,
            'acronym' => 'LD',
        ]);
        Teacher::create([
            'user_id' => 5,
            'year_id' => 1,
            'acronym' => 'AP',
        ]);
        Teacher::create([
            'user_id' => 6,
            'year_id' => 1,
            'acronym' => 'CO',
        ]);
    }
}
