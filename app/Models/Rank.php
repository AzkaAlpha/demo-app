<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'ranks';

    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
