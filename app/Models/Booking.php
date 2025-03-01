<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'tour_id',
        'booking_date',
        'travel_date',
        'num_people',
        'total_price',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'travel_date' => 'date',
    ];

    // Quan hệ với bảng users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với bảng tours
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
