<?php

namespace App\Models;

use App\Models\User;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';

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
