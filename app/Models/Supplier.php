<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'service_type',
        'contract_start_date',
        'contract_end_date',
        'hotel_id',

    ];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_suplier');
    }
}