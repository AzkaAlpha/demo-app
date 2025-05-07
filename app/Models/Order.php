<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vendor;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'vendor_id',
        'regarding',
        'order_date',
        'status',
        'processed',
        'verified',
        'validated',
        'approved',
        'rejected',
        'note'
    ];




    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }


    public function processedOrder()
    {
        return $this->belongsTo(User::class, 'processed', 'id' );
    }
    
    public function verifiedOrder()
    {
        return $this->belongsTo(User::class, 'verified', 'id' );
    }

    public function validatedOrder()
    {
        return $this->belongsTo(User::class, 'validated', 'id' );
    }

    public function approvedOrder()
    {
        return $this->belongsTo(User::class, 'approved', 'id' );
    }

    public function rejectedOrder()
    {
        return $this->belongsTo(User::class, 'rejected', 'id' );
    }
    

    public static function getStatusColor($status)
    {
        return match($status) {
            'pending' => 'yellow',
            'process' => 'blue',
            'verified' => 'green',
            'validated' => 'green',
            'approved' => 'emerald',
            'rejected' => 'red',
            default => 'gray'
        };
    }

    public static function getStatusLabel($status)
    {
        return match($status) {
            'pending' => 'Menunggu',
            'process' => 'Diproses',
            'verified' => 'Diverifikasi',
            'validated' => 'Divalidasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => ucfirst($status)
        };
    }

}
