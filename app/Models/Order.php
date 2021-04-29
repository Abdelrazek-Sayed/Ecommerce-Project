<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'stripe_order_id',
        'payment_type',
        'payment_id',
        'paying_amount',
        'balance_transaction',
        'subtotal',
        'shipping_charge',
        'vat',
        'total',
        'status',
        'status_code',
        'return_order',
        'date',
        'month',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }
}
