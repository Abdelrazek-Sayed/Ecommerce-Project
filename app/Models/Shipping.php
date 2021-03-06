<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'oredr_id',
        'ship_name',
        'ship_phone',
        'ship_email',
        'ship_address',
        'ship_city',
    ];
}
