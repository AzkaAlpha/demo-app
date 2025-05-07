<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DemandItem extends Model
{
    protected $fillable = [
        'demand_id',
        'name',
        'description',
        'quantity',
        'unit',
        'note',
    ];

    public function demand()
    {
        return $this->belongsTo(Demand::class);
    }
}
