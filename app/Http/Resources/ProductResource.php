<?php

namespace App\Http\Resources;

use App\Helpers\FileManageHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'category_id' => $this->product_category_id,
            'sub_category_id' => $this->product_sub_category_id,
            'brand_id' => $this->brand_id,
            'vendor_id' => $this->vendor_id,
            'label' => $this->label,
            'labels' => $this->labels ?? [],
            'featured_image' => FileManageHelper::getS3FileUrl($this->featured_image),
            'video_link' => $this->video_link,
            'condition' => $this->condition,
            'short_description' => $this->short_description,
            'is_featured' => $this->is_featured,
            'is_trending' => $this->is_trending,
            'is_top_sale' => $this->is_top_sale,
            'is_active' => $this->is_active,
            'value' => new ProductValueResource($this->whenLoaded('value')),
            'gallery' => ProductGalleryResource::collection($this->whenLoaded('galleries')),
            'attributes' => ProductAttributeResource::collection($this->whenLoaded('attributes')),
            'variations' => VariationResource::collection($this->whenLoaded('variations')) ?? [],
            'variation_combinations' => VariationCombinationResource::collection($this->whenLoaded('variantCombinations')) ?? [],
        ];
    }
}
