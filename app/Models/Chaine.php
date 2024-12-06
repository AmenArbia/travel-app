<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chaine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    protected $casts = [
        'image' => 'array',
    ];


    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }
}
