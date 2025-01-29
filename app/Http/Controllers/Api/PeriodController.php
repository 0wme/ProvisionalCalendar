<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Trimester;
use App\Models\Year;

class PeriodController extends Controller
{
    public function getPeriodsByYear($year_id)
    {
        $year = Year::where('id', $year_id)->first();

        if (!$year) {
            return response()->json([
                'error' => 'Année non trouvée'
            ], 404);
        }

        if ($year->periodicity === 'Semestrial') {
            $periods = Semester::where('year_id', $year_id)->get()
            ->map(function ($period) {
                return [
                    'id' => $period->id,
                    'number' => $period->semester_number,
                ];
            });

            if ($periods->isEmpty()) {
                return response()->json([
                    'error' => 'Il n\'y a pas de semestres pour cette annee'
                ], 404);
            }

            return response()->json([ 'semesters' => $periods ]);
        } else if ($year->periodicity === 'Trimestrial') {
            $periods = Trimester::where('year_id', $year_id)->get()
            ->map(function ($period) {
                return [
                    'id' => $period->id,
                    'number' => $period->trimester_number,
                ];
            });

            if ($periods->isEmpty()) {
                return response()->json([
                    'error' => 'Il n\'y a pas de trimestres pour cette annee'
                ], 404);
            }

            return response()->json([ 'trimesters' => $periods ]);
        }

        return response()->json([
            'error' => 'L\'annee n\'existe pas'
        ], 404);
    }
}
