<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Amenities extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
        'room_id',
<<<<<<< HEAD
        'icon',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    protected $translatable = [
        'title'
=======
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
    ];


    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_amenity', 'amenity_id', 'hotel_id')->withPivot('is_free', 'price');
        ;
<<<<<<< HEAD
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_amenity', 'amenity_id', 'booking_id')
        ->withPivot('is_free', 'price');

=======
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function bookings()
{
    return $this->belongsToMany(Booking::class, 'booking_amenity' , 'amenity_id', 'booking_id')
                ->withPivot('is_free', 'price');
}
}