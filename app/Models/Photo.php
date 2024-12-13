<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'photos',
        'caption',
        'type',
        'hotel_id',
    ];

    protected $casts =
    [
        'photos' => 'array',
    ];


    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}