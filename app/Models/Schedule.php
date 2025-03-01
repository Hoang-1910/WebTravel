<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    
    protected $fillable = ['tour_id', 'day_number', 'activity'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
