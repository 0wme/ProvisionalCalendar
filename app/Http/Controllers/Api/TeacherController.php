<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Year;
use App\Models\Teaching;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeachers($year): JsonResponse
    {
        try {
            // Vérifie si l'année existe
            $yearExists = Year::find($year);
            if (!$yearExists) {
                return response()->json([
                    'error' => 'Année non trouvée'
                ], 404);
            }

            // Récupère les enseignants avec leurs enseignements pour l'année spécifiée
            $teachers = Teacher::with(['teachings'])
                ->where('year_id', $year)
                ->get()
                ->map(function ($teacher) {
                    return [
                        'id' => $teacher->id,
                        'acronym' => $teacher->acronym,
                        'first_name' => $teacher->first_name,
                        'last_name' => $teacher->last_name,
                        'teachings' => $teacher->teachings->map(function ($teaching) {
                            return [
                                'id' => $teaching->id,
                                'title' => $teaching->title,
                                'apogee_code' => $teaching->apogee_code
                            ];
                        })
                    ];
                });

            return response()->json($teachers);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getTeachersByTeaching($teaching_id): JsonResponse
    {
        try {
            // Vérifie si l'enseignement existe
            $teaching = Teaching::find($teaching_id);
            if (!$teaching) {
                return response()->json([
                    'error' => 'Enseignement non trouvé'
                ], 404);
            }

            // Récupère les enseignants assignés à cet enseignement
            $teachers = $teaching->teachers->map(function ($teacher) {
                return [
                    'id' => $teacher->id,
                    'acronym' => $teacher->acronym,
                    'first_name' => $teacher->first_name,
                    'last_name' => $teacher->last_name
                ];
            });

            return response()->json($teachers);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getTeacher($teacher_id): JsonResponse
    {
        try {
            // Vérifie si l'enseignant existe
            $teacher = Teacher::with(['teachings', 'year'])
                ->find($teacher_id);

            if (!$teacher) {
                return response()->json([
                    'error' => 'Enseignant non trouvé'
                ], 404);
            }

            // Prépare la réponse avec les données de l'enseignant
            $response = [
                'id' => $teacher->id,
                'acronym' => $teacher->acronym,
                'first_name' => $teacher->first_name,
                'last_name' => $teacher->last_name,
                'year' => [
                    'id' => $teacher->year->id,
                    'name' => $teacher->year->name
                ],
                'teachings' => $teacher->teachings->map(function ($teaching) {
                    return [
                        'id' => $teaching->id,
                        'title' => $teaching->title,
                        'apogee_code' => $teaching->apogee_code
                    ];
                })
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function storeTeacher(Request $request, $year): JsonResponse
    {
        try {
            $request->validate([
                'acronym' => 'required|string|max:10',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'user_id' => 'required|exists:users,id'
            ]);

            // Vérifie si l'année existe
            $yearExists = Year::find($year);
            if (!$yearExists) {
                return response()->json([
                    'error' => 'Année non trouvée'
                ], 404);
            }

            // Vérifie si un enseignant avec le même acronyme existe déjà pour cette année
            $existingTeacher = Teacher::where('acronym', $request->acronym)
                ->where('year_id', $year)
                ->first();

            if ($existingTeacher) {
                return response()->json([
                    'error' => 'Un enseignant avec cet acronyme existe déjà pour cette année'
                ], 422);
            }

            $teacher = Teacher::create([
                'acronym' => $request->acronym,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'user_id' => $request->user_id,
                'year_id' => $year
            ]);

            return response()->json([
                'message' => 'Enseignant créé avec succès',
                'teacher' => [
                    'id' => $teacher->id,
                    'acronym' => $teacher->acronym,
                    'first_name' => $teacher->first_name,
                    'last_name' => $teacher->last_name,
                    'user_id' => $teacher->user_id,
                    'year_id' => $teacher->year_id
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateTeacher(Request $request, $teacher_id): JsonResponse
    {
        try {
            $request->validate([
                'acronym' => 'required|string|max:10',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'user_id' => 'required|exists:users,id'
            ]);

            // Vérifie si l'enseignant existe
            $teacher = Teacher::find($teacher_id);
            if (!$teacher) {
                return response()->json([
                    'error' => 'Enseignant non trouvé'
                ], 404);
            }

            // Vérifie si un autre enseignant avec le même acronyme existe déjà pour cette année
            $existingTeacher = Teacher::where('acronym', $request->acronym)
                ->where('year_id', $teacher->year_id)
                ->where('id', '!=', $teacher_id)
                ->first();

            if ($existingTeacher) {
                return response()->json([
                    'error' => 'Un enseignant avec cet acronyme existe déjà pour cette année'
                ], 422);
            }

            $teacher->update([
                'acronym' => $request->acronym,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'user_id' => $request->user_id
            ]);

            // Charge les relations pour la réponse
            $teacher->load(['teachings', 'year']);

            return response()->json([
                'message' => 'Enseignant modifié avec succès',
                'teacher' => [
                    'id' => $teacher->id,
                    'acronym' => $teacher->acronym,
                    'first_name' => $teacher->first_name,
                    'last_name' => $teacher->last_name,
                    'year' => [
                        'id' => $teacher->year->id,
                        'name' => $teacher->year->name
                    ],
                    'teachings' => $teacher->teachings->map(function ($teaching) {
                        return [
                            'id' => $teaching->id,
                            'title' => $teaching->title,
                            'apogee_code' => $teaching->apogee_code
                        ];
                    })
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
