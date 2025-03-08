<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // Tên bảng trong database

    protected $fillable = [
        'user_id',
        'tour_id',
        'departure_location',
        'departure_date',
        'num_people',
        'total_price',
        'status'
    ];

    protected $dates = ['travel_date', 'departure_date'];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
