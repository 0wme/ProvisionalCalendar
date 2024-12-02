<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = [
        'name',
        'periodicity',
    ];

    public function weeks()
    {
        return $this->hasMany(Week::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function teachings()
    {
        return $this->hasMany(Teaching::class);
    }

    public function academicPromotions()
    {
        return $this->hasMany(AcademicPromotion::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function trimesters()
    {
        return $this->hasMany(Trimester::class);
    }
}
