<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Week;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Slot;

class CalendarPageController extends Controller 
{

    /**
     * Crée un nouveau slot dans l'emploi du temps
     */
    public function storeSlot(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'duration' => 'required|numeric|min:0',
                'teacher_id' => 'required|exists:teachers,id',
                'teaching_id' => 'required|exists:teachings,id',
                'substitute_teacher_id' => 'nullable|exists:teachers,id',
                'academic_promotion_id' => 'nullable|exists:academic_promotions,id',
                'academic_group_id' => 'nullable|exists:academic_groups,id',
                'academic_subgroup_id' => 'nullable|exists:academic_subgroups,id',
                'is_neutralized' => 'boolean',
                'week_id' => 'required|exists:weeks,id',
                'type' => 'required|in:CM,TD,TP'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Données invalides',
                    'messages' => $validator->errors()
                ], 422);
            }

            // Vérifier que l'enseignant n'a pas déjà un cours à ce moment
            $existingSlot = Slot::where('week_id', $request->week_id)
                ->where(function ($query) use ($request) {
                    $query->where('teacher_id', $request->teacher_id)
                        ->orWhere('substitute_teacher_id', $request->teacher_id);
                })
                ->first();

            if ($existingSlot) {
                return response()->json([
                    'error' => 'L\'enseignant a déjà un cours prévu à ce moment'
                ], 422);
            }

            // Créer le slot
            $slot = Slot::create($request->all());

            // Charger les relations pour la réponse
            $slot->load(['teacher', 'substituteTeacher', 'teaching', 'academicPromotion']);

            return response()->json([
                'message' => 'Slot créé avec succès',
                'slot' => $slot
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function getCalendarData($year_id): JsonResponse
    {
        try {
            // Récupérer les semaines avec leurs créneaux
            $weeks = Week::where('year_id', $year_id)
                        ->with([
                            'slots.teacher', 
                            'slots.academicPromotion.academicGroups.academicSubgroups'
                        ])
                        ->orderBy('week_number')
                        ->get();

 
            $calendarData = $weeks->map(function ($week) {
                return [
                    'week' => $week->week_number,
                    'groups' => $this->formatPromotionGroups($week->slots)
                ];
            });

            return response()->json($calendarData);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function formatPromotionGroups($slots) 
    {
        return $slots->groupBy('academic_promotion_id')
            ->map(function ($promotionSlots) {
                return [
                    'contents' => $this->formatSlotContents($promotionSlots->where('type', 'CM')),
                    'groups' => $this->formatGroups($promotionSlots)
                ];
            })->values();
    }

    private function formatGroups($promotionSlots) 
    {
        return $promotionSlots->groupBy('academic_group_id')
            ->map(function ($groupSlots) {
                return [
                    'contents' => $this->formatSlotContents($groupSlots->where('type', 'TD')),
                    'groups' => $this->formatSubgroups($groupSlots)
                ];
            })->values();
    }

    private function formatSubgroups($groupSlots) 
    {
        return $groupSlots->groupBy('academic_subgroup_id')
            ->map(function ($subgroupSlots) {
                return [
                    'contents' => $this->formatSlotContents($subgroupSlots->where('type', 'TP'))
                ];
            })->values();
    }

    private function formatSlotContents($slots) 
    {
        return $slots->map(function ($slot) {
            return [
                'hours' => $slot->duration,
                'teacherCode' => $slot->teacher ? $slot->teacher->acronym : null
            ];
        })->values()->all();
    }
}