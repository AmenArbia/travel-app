<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_capacity',
        'description',
        'name',
        'price',
        'photos',
        'hotel_id',
        'room_id',
    ];

    protected $casts = [
        'photos' => 'array'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
