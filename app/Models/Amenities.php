<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
    ];


    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_amenity', 'amenity_id', 'hotel_id')->withPivot('is_free', 'price');;
    }
}