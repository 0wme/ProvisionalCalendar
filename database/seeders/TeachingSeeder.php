<?php

namespace Database\Seeders;

use App\Models\Teaching;
use Illuminate\Database\Seeder;

class TeachingSeeder extends Seeder
{
    public function run(): void
    {
        $teachings = [
            [
                'title' => 'R1.01 - Initiation à la programmation',
                'apogee_code' => 'PROG_R1.01',
                'tp_hours_initial' => 20.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
            ],
            [
                'title' => 'R3.02 - Programmation Web',
                'apogee_code' => 'WEB_R1.02',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 20.00,
                'cm_hours_continued' => null,
            ],
            [
                'title' => 'R5.05 - PHP Laravel',
                'apogee_code' => 'WEB_R1.05',
                'tp_hours_initial' => 20.00,
                'tp_hours_continued' => 15.00,
                'td_hours_intial' => 20.00,
                'td_hours_continued' => 15.00,
                'cm_hours_initial' => 25.00,
                'cm_hours_continued' => 20.00,
            ],
            // Ajoutez d'autres enseignements ici si nécessaire
        ];

        foreach ($teachings as $teaching) {
            Teaching::create($teaching);
        }
    }
}
