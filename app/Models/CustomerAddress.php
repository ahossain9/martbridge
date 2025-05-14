<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'address2',
        'city',
        'state',
        'zip_code',
        'country',
        'status',
        'is_default',
        'type',
    ];
}
