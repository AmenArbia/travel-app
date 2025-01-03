<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Hotel extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'name',
        'slug',
        'description',
    ];
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_cover',
        'emails',
        'contact',
        'tel',
        'nom',
        'status',
        'type_hotel',
        'chaine_id',
        'country_id',
        'city_id',
        'rating',
        'latitude',
        'longitude',
        'street',
    ];

    protected $casts = [
        'contact' => 'array',
        'name' => 'array',
        'slug' => 'array',
        'description' => 'array',
    ];





    public function chaine()
    {
        return $this->belongsTo(Chaine::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, "hotel_supplier", 'hotel_id', 'supplier_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenities::class, 'hotel_amenity', 'hotel_id', 'amenity_id')->withPivot('is_free', 'price');
    }

    public function room()
    {
        return $this->belongsToMany(Room::class, 'hotel_room')->withPivot('code', 'description');
    }

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function roomtype()
    {
        return $this->hasMany(TypeRoom::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
