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
            'last_name' => 'DUBREUIL'
        ]);
        Teacher::create([
            'user_id' => 2,
            'year_id' => 1,
            'acronym' => 'AP',
            'first_name' => 'Anais',
            'last_name' => 'POURSAT'
        ]);
        Teacher::create([
            'user_id' => 3,
            'year_id' => 1,
            'acronym' => 'CO',
            'first_name' => 'Cristina',
            'last_name' => 'ONETE'
        ]);
    }
}
