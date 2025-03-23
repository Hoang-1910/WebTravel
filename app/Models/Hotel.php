<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location_id', 'rating'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
