<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Week;
use Illuminate\Http\JsonResponse;

class CalendarPageController extends Controller 
{
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
                'teacherName' => $slot->teacher ? $slot->teacher->first_name . ' ' . $slot->teacher->last_name : null
            ];
        })->values()->all(); // Ajout de all() pour convertir en tableau
    }
}