<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductValueResource extends JsonResource
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
            'product_id' => $this->product_id,
            'base_price' => $this->base_price,
            'sale_price' => $this->sale_price,
            'promo_price' => $this->promo_price,
            'advance_amount' => $this->advance_amount,
            'allow_coupon' => $this->allow_coupon,
            'sku' => $this->sku,
            'stock' => $this->stock,
            'moq' => $this->moq,
        ];
    }
}
