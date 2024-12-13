<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'description',
        'pax_capacity',
        'adult_capacity',
        'children_capacity',
        'infants_capacity',
        'extra_capacity',
        'type',

    ];

    protected $casts = [
        'pax_capacity' => 'array',
        'adult_capacity' => 'array',
        'children_capacity' => 'array',
        'infants_capacity' => 'array',
        'extra_capacity' => 'array',
    ];


    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_room')->withPivot('code', 'description');
    }

    public function roomtype()
    {
        return $this->hasMany(TypeRoom::class);
    }
}