<?php

use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\TeacherTeachingController;

//Groupes

    //Récupération des données

    Route::get('/groupes/{year}', [GroupController::class, 'index']);
    Route::get('/groupes/promotion/{academic_promotion}', [GroupController::class, 'getByPromotion']);
    Route::get('/groupes/groupe/{group}', [GroupController::class, 'getByGroup']);
    Route::get('/groupes/sous-groupe/{subgroup}', [GroupController::class, 'getBySubgroup']);

    //Création des données

    Route::post('/groupes/promotion/{year}', [GroupController::class, 'storePromotion']);
    Route::post('/groupes/groupe/{promotion}', [GroupController::class, 'storeGroup']);
    Route::post('/groupes/sous-groupe/{group}', [GroupController::class, 'storeSubgroup']);

    //Modification des données

    Route::put('/groupes/promotion/{promotion}', [GroupController::class, 'updatePromotion']);
    Route::put('/groupes/groupe/{group}', [GroupController::class, 'updateGroup']);
    Route::put('/groupes/sous-groupe/{subgroup}', [GroupController::class, 'updateSubgroup']);

    //Suppression des données

    Route::delete('/groupes/promotion/{promotion}', [GroupController::class, 'deletePromotion']);
    Route::delete('/groupes/groupe/{group}', [GroupController::class, 'deleteGroup']);
    Route::delete('/groupes/sous-groupe/{subgroup}', [GroupController::class, 'deleteSubgroup']);

//Enseignants

    Route::get('/enseignants/{year}', [TeacherTeachingController::class, 'getTeachers']);
    Route::get('/enseignements/{year}', [TeacherTeachingController::class, 'getTeachings']);
    Route::get('/enseignement/enseignants/{teaching}', [TeacherTeachingController::class, 'getTeachersByTeaching']);
    Route::get('/enseignant/enseignements/{teacher}', [TeacherTeachingController::class, 'getTeachingsByTeacher']);
    