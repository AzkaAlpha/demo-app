<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'description',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'contact_person',
        'contact_email',
        'contact_phone',
        'is_active',
        'note',
    ];
}
