<?php

namespace Database\Seeders;

use App\Models\Teaching;
use App\Models\Year;
use App\Models\Semester;
use App\Models\Trimester;
use Illuminate\Database\Seeder;

class TeachingSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les enseignements pour les années semestrielles
        $semesterYear = Year::where('periodicity', 'Semestrial')->first();
        if ($semesterYear) {
            $semester = Semester::where('year_id', $semesterYear->id)->first();
            if ($semester) {
                $this->createSemestrialTeachings($semesterYear, $semester);
            }
        }

        // Créer les enseignements pour les années trimestrielles
        $trimesterYear = Year::where('periodicity', 'Trimestrial')->first();
        if ($trimesterYear) {
            $trimester = Trimester::where('year_id', $trimesterYear->id)->first();
            if ($trimester) {
                $this->createTrimestrialTeachings($trimesterYear, $trimester);
            }
        }
    }

    private function createTrimestrialTeachings(Year $year, Trimester $trimester): void
    {
        Teaching::create([
            'title' => 'R1.01 - Initiation à la programmation',
            'apogee_code' => 'PROG_R1.01',
            'tp_hours_initial' => 20.00,
            'td_hours_intial' => 15.00,
            'cm_hours_initial' => 10.00,
            'trimester_id' => $trimester->id,
            'semester_id' => null,
            'year_id' => $year->id
        ]);

        Teaching::create([
            'title' => 'R1.02 - Développement web',
            'apogee_code' => 'WEB_R1.02',
            'tp_hours_initial' => 15.00,
            'td_hours_intial' => 15.00,
            'cm_hours_initial' => 15.00,
            'trimester_id' => $trimester->id,
            'semester_id' => null,
            'year_id' => $year->id
        ]);
    }

    private function createSemestrialTeachings(Year $year, Semester $semester): void
    {
        Teaching::create([
            'title' => 'R1.01 - Initiation à la programmation',
            'apogee_code' => 'PROG_R1.01',
            'tp_hours_initial' => 20.00,
            'td_hours_intial' => 15.00,
            'cm_hours_initial' => 10.00,
            'semester_id' => $semester->id,
            'trimester_id' => null,
            'year_id' => $year->id
        ]);

        Teaching::create([
            'title' => 'R1.02 - Développement web',
            'apogee_code' => 'WEB_R1.02',
            'tp_hours_initial' => 15.00,
            'td_hours_intial' => 15.00,
            'cm_hours_initial' => 15.00,
            'semester_id' => $semester->id,
            'trimester_id' => null,
            'year_id' => $year->id
        ]);
    }
}
