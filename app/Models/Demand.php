<?php

namespace App\Models;

use App\Models\User;
use App\Models\DemandItem;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'demand_number',
        'user_id',
        'regarding',
        'description',
        'demand_date',
        'status',
        'processed',
        'approved',
        'rejected',
        'note'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function demandItems()
    {
        return $this->hasMany(DemandItem::class);
    }

    public function processedDemand()
    {
        return $this->belongsTo(User::class, 'processed', 'id' );
    }

    public function approvedDemand()
    {
        return $this->belongsTo(User::class, 'approved', 'id' );
    }

    public function rejectedDemand()
    {
        return $this->belongsTo(User::class, 'rejected', 'id' );
    }

    public static function getStatusColor($status)
    {
        return match($status) {
            'pending' => 'yellow',
            'processed' => 'blue',
            'approved' => 'emerald',
            'rejected' => 'red',
            default => 'gray'
        };
    }
    public static function getStatusLabel($status)
    {
        return match($status) {
            'pending' => 'Menunggu',
            'processed' => 'Diproses',
            'approved' => 'Disetujui',
            'rejected' =>'Ditolak',
            default => 'Unknown'
        };
    }
    


}
