<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trimester extends Model
{
    protected $fillable = [
        'trimester_number',
        'year_id'
    ];
}
