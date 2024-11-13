<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSubgroup extends Model
{
    protected $fillable = [
        'name',
        'academic_group_id',
    ];

    public function academicGroup()
    {
        return $this->belongsTo(AcademicGroup::class);
    }
}
