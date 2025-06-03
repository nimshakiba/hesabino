<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'mobile', 'active', 'person_category_id'
    ];

    public function category()
    {
        return $this->belongsTo(PersonCategory::class, 'person_category_id');
    }
}
