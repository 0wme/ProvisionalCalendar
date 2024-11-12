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
    ];
}
