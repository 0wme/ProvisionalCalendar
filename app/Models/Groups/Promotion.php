<?php

namespace App\Models\Groups;

use App\Models\Year;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'name',
        'year_id',
    ];

    public function academicGroups()
    {
        return $this->hasMany(Group::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
