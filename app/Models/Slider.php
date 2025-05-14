<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'third_title',
        'image',
        'link',
        'link_text',
        'base_price',
        'discount_price',
        'discount_text',
        'created_by',
        'updated_by',
        'slider_type',
        'priority',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Cache::forget('sliders');
            Cache::forget('banners');
        });

        static::updating(function ($model) {
            Cache::forget('sliders');
            Cache::forget('banners');
        });

        static::deleting(function ($model) {
            Cache::forget('sliders');
            Cache::forget('banners');
        });

    }
}
