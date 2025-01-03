<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
        'country_name',

    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }

    public static function booted()
    {
        static::saving(function ($city) {
            if ($city->country) {
                $city->country_name = $city->country->name;
            }
        });
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
