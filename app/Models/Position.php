<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
