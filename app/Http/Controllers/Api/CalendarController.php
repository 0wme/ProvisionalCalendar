<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use App\Models\Week;
use App\Models\Teacher;
use App\Models\Teaching;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    /**
     * Récupère les slots pour une semaine donnée
     */
    public function getSlots($week_id): JsonResponse
    {
        try {
            $week = Week::with(['slots' => function ($query) {
                $query->with(['teacher', 'substituteTeacher', 'teaching', 'academicPromotion']);
            }])->findOrFail($week_id);

            return response()->json([
                'message' => 'Slots récupérés avec succès',
                'slots' => $week->slots
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

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
}
