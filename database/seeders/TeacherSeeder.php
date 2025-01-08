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
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'AP',
            'first_name' => 'Anais',
            'last_name' => 'POURSAT',
        ]);
        Teacher::create([
            'user_id' => 3,
            'year_id' => 1,
            'acronym' => 'CO',
            'first_name' => 'Cristina',
            'last_name' => 'ONETE',           
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'EJ',
            'first_name' => 'Elise',
            'last_name' => 'JOFFRE',
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'SF',
            'first_name' => 'Said',
            'last_name' => 'FETTAHI',
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'DM',
            'first_name' => 'David',
            'last_name' => 'MINGO',
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'SM',
            'first_name' => 'Stephane',
            'last_name' => 'MERILLOU',
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'NM',
            'first_name' => 'Nicolas',
            'last_name' => 'MERILLOU',
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'VB',
            'first_name' => 'Véronique',
            'last_name' => 'BAULANT',
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'PN',
            'first_name' => 'Pierre-Antoine',
            'last_name' => 'NAVARETTE',

        ]);
    }
}
