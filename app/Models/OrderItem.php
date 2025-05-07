<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'description',
        'quantity',
        'unit',
        'price',
        'total',
        'note'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
