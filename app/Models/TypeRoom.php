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
        'pax_capacity',
        'adult_capacity',
        'children_capacity',
        'infants_capacity',
        'room_highlights',
    ];

    protected $casts = [
        'photos' => 'array',
        'pax_capacity' => 'array',
        'adult_capacity' => 'array',
        'children_capacity' => 'array',
        'infants_capacity' => 'array',
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
