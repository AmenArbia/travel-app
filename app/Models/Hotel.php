<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

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
    ];

    protected $casts = [
        'contact' => 'array'
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
        return $this->hasMany(Supplier::class);
    }
}