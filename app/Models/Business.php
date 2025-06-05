<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'user_id', 'name', 'database_name'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
