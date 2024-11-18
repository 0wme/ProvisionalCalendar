<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    protected $fillable = [
        'title',
        'apogee_code',
        'tp_hours_initial',
        'tp_hours_continued',
        'td_hours_intial',
        'td_hours_continued',
        'cm_hours_initial',
        'cm_hours_continued',
        'semestre',
        'trimestre',
        'year_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($teaching) {
            if (($teaching->semestre !== null && $teaching->trimestre !== null) || 
                ($teaching->semestre === null && $teaching->trimestre === null)) {
                throw new \InvalidArgumentException(
                    'Un enseignement doit avoir soit un semestre, soit un trimestre, mais pas les deux.'
                );
            }
        });
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teachers_teachings');
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}
