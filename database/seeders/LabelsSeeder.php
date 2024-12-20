<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = [
            'Enseignants',
            'Enseignements',
            'Mode Enseignants',
            'Mode Enseignements',
            'Calendrier Prévisionnel',
            'Enseignants/Enseignements',
            'Mode Édition',
            'S',
            'CM',
            'TD',
            'TP',
            'M3C',
            'Initiale',
            'Continue',
            'Promotion',
            'Groupe',
            'Demi-groupe',
            'EDT',
            'Services',
            'Déconnexion'
        ];

        foreach ($labels as $label) {
            \App\Models\Label::create([
                'original_name' => $label,
            ]);
        }
    }
}
