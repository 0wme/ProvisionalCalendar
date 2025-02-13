<?php

namespace App\Models\Groups;

use App\Models\Slot;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'promotion_id',
    ];

    public function academicPromotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function academicSubgroups()
    {
        return $this->hasMany(Subgroup::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($group) {
            // Delete associated slots first
            $group->slots()->delete();
        });
    }
}
