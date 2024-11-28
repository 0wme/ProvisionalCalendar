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
            'user_id' => $user->id,
            'year_id' => $year->id,
            'acronym' => 'LD',
            'first_name' => 'Laurent',
            'last_name' => 'DUBREUIL'
        ]);
    }
}
