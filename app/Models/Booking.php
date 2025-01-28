<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'roomtype_id',
        'check_in_date',
        'check_out_date',
        'capacity',
        'adults',
        'children',
        'infants',
        'price_per_night',
        'total_price',
        'name',
        'email',
        'phone',
        'address',
        'coupon_code',
<<<<<<< HEAD
        'country_id',
        'city_id',
        'room_id',
        'booking_status',
        'is_confirmed'
=======
        'booking_status',
        'country_id',
        'city_id',
        'booking_status',
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df



    ];



    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function roomtype()
    {
        return $this->belongsTo(TypeRoom::class);
    }

    public function amenities()
<<<<<<< HEAD
    {
        return $this->belongsToMany(Amenities::class, 'booking_amenity', 'booking_id', 'amenity_id')
            ->withPivot('is_free', 'price');
    }
=======
{
    return $this->belongsToMany(Amenities::class, 'booking_amenity' , 'booking_id', 'amenity_id')
                ->withPivot('is_free', 'price');
}
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
