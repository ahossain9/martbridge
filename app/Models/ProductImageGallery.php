<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImageGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_gallery_id',
        'is_featured',
    ];

    public function images()
    {
        return $this->belongsTo(ImageGallery::class, 'image_gallery_id', 'id');
    }
}
