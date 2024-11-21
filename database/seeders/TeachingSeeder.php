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
                'semestre' => 1,
                'trimestre' => null,
                'year_id' => 1
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
                'semestre' => null,
                'trimestre' => 3,
                'year_id' => 1
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
                'semestre' => 5,
                'trimestre' => null,
                'year_id' => 1
            ],

            [
                'title' => 'R1.02 - Mathématiques pour l\'informatique',
                'apogee_code' => 'MATH_R1.02',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 1,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R1.03 - Introduction aux réseaux',
                'apogee_code' => 'NETR1.03',
                'tp_hours_initial' => 10.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 1,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R1.04 - Bases de données',
                'apogee_code' => 'DB_R1.04',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 1,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R2.01 - Algorithmique et programmation',
                'apogee_code' => 'ALGR2.01',
                'tp_hours_initial' => 20.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 2,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R2.02 - Analyse numérique',
                'apogee_code' => 'NUM2.02',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 2,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R2.03 - Systèmes d\'exploitation',
                'apogee_code' => 'OSR2.03',
                'tp_hours_initial' => 10.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 2,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R2.04 - Sécurité des systèmes d\'information',
                'apogee_code' => 'SECR2.04',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 2,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R3.01 - Conception de systèmes',
                'apogee_code' => 'SYSTR3.01',
                'tp_hours_initial' => 20.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 3,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R3.03 - Réseaux de communication',
                'apogee_code' => 'NETWR3.03',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 3,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R3.04 - Gestion de projet',
                'apogee_code' => 'PROJR3.04',
                'tp_hours_initial' => 10.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 3,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R4.01 - Intelligence artificielle',
                'apogee_code' => 'AIR4.01',
                'tp_hours_initial' => 20.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 4,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R4.02 - Analyse de données',
                'apogee_code' => 'DATAR4.02',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 4,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R4.03 - Sécurité des données',
                'apogee_code' => 'DAT_R4.03',
                'tp_hours_initial' => 10.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 4,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R4.04 - Gestion de la chaîne d\'approvisionnement',
                'apogee_code' => 'SUPY_R4.04',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 4,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R5.01 - Architecture des ordinateurs',
                'apogee_code' => 'COMP5.01',
                'tp_hours_initial' => 20.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 5,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R5.02 - Systèmes embarqués',
                'apogee_code' => 'EMB5.02',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 5,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R5.03 - Réseaux de capteurs',
                'apogee_code' => 'SENSOR5.03',
                'tp_hours_initial' => 10.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 15.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 10.00,
                'cm_hours_continued' => null,
                'semestre' => 5,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R5.04 - Informatique graphique',
                'apogee_code' => 'GRAPHR5.04',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 5,
                'trimestre' => null,
                'year_id' => 1
            ],
            [
                'title' => 'R5.01 - Développement mobile',
                'apogee_code' => 'GRAPHR5.01',
                'tp_hours_initial' => 15.00,
                'tp_hours_continued' => null,
                'td_hours_intial' => 10.00,
                'td_hours_continued' => null,
                'cm_hours_initial' => 15.00,
                'cm_hours_continued' => null,
                'semestre' => 0,
                'trimestre' => null,
                'year_id' => 1
            ]


        
        ];

        foreach ($teachings as $teaching) {
            Teaching::create($teaching);
        }
    }
}
