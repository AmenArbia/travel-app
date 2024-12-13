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
        'supplier_type',
        'service_type',
        'contract_start_date',
        'contract_end_date',
    ];

    public function hotels()
    {
        return $this->hasMany(Hotel::class, "hotel_supplier",  'supplier_id');
    }
}