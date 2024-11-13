<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = [
        'duration',
        'teacher_id',
        'teaching_id',
        'substitute_teacher_id',
        'academic_promotion_id',
        'academic_group_id',
        'academic_subgroup_id',
        'is_neutralized',
        'week_id',
    ];
}
