<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'category_id',
        'location_id',
        'image',
        'status',
        'max_people', // Thêm trường này
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function images()
    {
        return $this->hasMany(TourImage::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
