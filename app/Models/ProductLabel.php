<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'extra',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
