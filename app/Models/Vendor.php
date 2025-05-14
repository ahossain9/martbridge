<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'about',
        'address',
        'city',
        'country',
        'logo',
        'is_active',
        'banner',
        'created_by',
    ];
}
