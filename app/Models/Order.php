<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    protected $fillable = [
        'customer_id',
        'order_number',
        'status',
        'delivery_method',
        'subtotal_price',
        'discount_amount',
        'discount_type',
        'total_price',
    ];

    public function orderDetails(): HasOne
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
