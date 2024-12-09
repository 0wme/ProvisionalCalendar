<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $years = Year::with(['semesters', 'trimesters'])
                ->get()
                ->map(function ($year) {
                    return [
                        'id' => $year->id,
                        'name' => $year->name,
                        'periodicity' => $year->periodicity,
                        'periods' => $year->periodicity === 'Semestrial' 
                            ? $year->semesters->map(fn($s) => ['id' => $s->id, 'number' => $s->semester_number])
                            : $year->trimesters->map(fn($t) => ['id' => $t->id, 'number' => $t->trimester_number])
                    ];
                });

            return response()->json($years);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:years,name',
                'periodicity' => 'required|in:Semestrial,Trimestrial'
            ]);

            $year = Year::create([
                'name' => $request->name,
                'periodicity' => $request->periodicity
            ]);

            return response()->json([
                'message' => 'Année créée avec succès',
                'year' => [
                    'id' => $year->id,
                    'name' => $year->name,
                    'periodicity' => $year->periodicity
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function clone(Request $request, $id): JsonResponse
    {
        try {
            $sourceYear = Year::with([
                'semesters', 
                'trimesters', 
                'teachings.teachers',
                'teachers',
                'academicPromotions.academicGroups.academicSubgroups',
                'weeks.slots'
            ])->findOrFail($id);
            
            $request->validate([
                'name' => 'required|string|max:255|unique:years,name',
            ]);
    
            // Création de la nouvelle année
            $newYear = Year::create([
                'name' => $request->name,
                'periodicity' => $sourceYear->periodicity
            ]);
    
            // Clone les semestres ou trimestres
            if ($sourceYear->periodicity === 'Semestrial') {
                foreach ($sourceYear->semesters as $semester) {
                    $newYear->semesters()->create([
                        'semester_number' => $semester->semester_number
                    ]);
                }
            } else {
                foreach ($sourceYear->trimesters as $trimester) {
                    $newYear->trimesters()->create([
                        'trimester_number' => $trimester->trimester_number
                    ]);
                }
            }
    
            // Clone les enseignements
            foreach ($sourceYear->teachings as $teaching) {
                $newTeaching = $newYear->teachings()->create([
                    'title' => $teaching->title,
                    'apogee_code' => $teaching->apogee_code,
                    'tp_hours_initial' => $teaching->tp_hours_initial,
                    'tp_hours_continued' => $teaching->tp_hours_continued,
                    'td_hours_intial' => $teaching->td_hours_intial,
                    'td_hours_continued' => $teaching->td_hours_continued,
                    'cm_hours_initial' => $teaching->cm_hours_initial,
                    'cm_hours_continued' => $teaching->cm_hours_continued,
                    'semester_id' => $teaching->semester_id,
                    'trimester_id' => $teaching->trimester_id
                ]);
            }
    
            // Clone les enseignants
            foreach ($sourceYear->teachers as $teacher) {
                $newTeacher = $newYear->teachers()->create([
                    'acronym' => $teacher->acronym,
                    'first_name' => $teacher->first_name,
                    'last_name' => $teacher->last_name,
                    'user_id' => $teacher->user_id
                ]);
            }
    
            // Clone les promotions, groupes et sous-groupes
            foreach ($sourceYear->academicPromotions as $promotion) {
                $newPromotion = $newYear->academicPromotions()->create([
                    'name' => $promotion->name
                ]);
    
                foreach ($promotion->academicGroups as $group) {
                    $newGroup = $newPromotion->academicGroups()->create([
                        'name' => $group->name
                    ]);
    
                    foreach ($group->academicSubgroups as $subgroup) {
                        $newGroup->academicSubgroups()->create([
                            'name' => $subgroup->name
                        ]);
                    }
                }
            }
    
            // Clone les semaines et les créneaux
            foreach ($sourceYear->weeks as $week) {
                $newWeek = $newYear->weeks()->create([
                    'name' => $week->name,
                    'week_number' => $week->week_number
                ]);
    
                foreach ($week->slots as $slot) {
                    $newWeek->slots()->create([
                        'start_time' => $slot->start_time,
                        'end_time' => $slot->end_time,
                        'day_of_week' => $slot->day_of_week,
                        'teaching_id' => $slot->teaching_id,
                        'teacher_id' => $slot->teacher_id,
                        'room' => $slot->room,
                        'type' => $slot->type,
                        'group_id' => $slot->group_id,
                        'subgroup_id' => $slot->subgroup_id
                    ]);
                }
            }
    
            return response()->json([
                'message' => 'Année clonée avec succès',
                'year' => [
                    'id' => $newYear->id,
                    'name' => $newYear->name,
                    'periodicity' => $newYear->periodicity
                ]
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $year = Year::with(['semesters', 'trimesters', 'teachings', 'teachers', 'academicPromotions'])
                ->find($id);

            if (!$year) {
                return response()->json([
                    'error' => 'Année non trouvée'
                ], 404);
            }

            return response()->json([
                'id' => $year->id,
                'name' => $year->name,
                'periodicity' => $year->periodicity,
                'periods' => $year->periodicity === 'Semestrial' 
                    ? $year->semesters->map(fn($s) => ['id' => $s->id, 'number' => $s->semester_number])
                    : $year->trimesters->map(fn($t) => ['id' => $t->id, 'number' => $t->trimester_number]),
                'teachings_count' => $year->teachings->count(),
                'teachers_count' => $year->teachers->count(),
                'promotions_count' => $year->academicPromotions->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
