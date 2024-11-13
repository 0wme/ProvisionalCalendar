<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\Teaching;
use Illuminate\Database\Seeder;

class TeacherTeachingSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer le premier enseignant (admin)
        $teacher = Teacher::where('acronym', 'ADM')->first();
        
        // Récupérer le cours de PHP Laravel
        $teaching = Teaching::where('apogee_code', 'WEB_R1.05')->first();

        // Créer l'association
        if ($teacher && $teaching) {
            $teacher->teachings()->attach($teaching->id);
        }
    }
}
