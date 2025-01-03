<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'region',
    ];


    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
