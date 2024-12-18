<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'user_id' => 1,
            'year_id' => 1,
            'acronym' => 'LD',
            'first_name' => 'Laurent',
            'last_name' => 'DUBREUIL',
            'email' => 'sofian.smimid+ld@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'AP',
            'first_name' => 'Anais',
            'last_name' => 'POURSAT',
            'email' => 'sofian.smimid+ap@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 3,
            'year_id' => 1,
            'acronym' => 'CO',
            'first_name' => 'Cristina',
            'last_name' => 'ONETE',           
             'email' => 'sofian.smimid+co@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'EJ',
            'first_name' => 'Elise',
            'last_name' => 'JOFFRE',
            'email' => 'sofian.smimid+ej@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'SF',
            'first_name' => 'Said',
            'last_name' => 'FETTAHI',
            'email' => 'sofian.smimid+sf@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'DM',
            'first_name' => 'David',
            'last_name' => 'MINGO',
            'email' => 'sofian.smimid+dm@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'SM',
            'first_name' => 'Stephane',
            'last_name' => 'MERILLOU',
            'email' => 'sofian.smimid+sm@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'NM',
            'first_name' => 'Nicolas',
            'last_name' => 'MERILLOU',
            'email' => 'sofian.smimid+nm@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'VB',
            'first_name' => 'Véronique',
            'last_name' => 'BAULANT',
            'email' => 'sofian.smimid+vb@etu.unilim.fr'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'PN',
            'first_name' => 'Pierre-Antoine',
            'last_name' => 'NAVARETTE',
            'email' => 'sofian.smimid+pn@etu.unilim.fr'

        ]);
    }
}
