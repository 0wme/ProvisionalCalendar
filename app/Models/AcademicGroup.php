<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicGroup extends Model
{
    protected $fillable = [
        'name',
        'academic_promotion_id',
    ];

    public function academicPromotion()
    {
        return $this->belongsTo(AcademicPromotion::class);
    }
}
