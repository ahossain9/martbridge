<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeResource extends JsonResource
{
    public static $wrap = 'false';

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
            'name' => $this->name,
            'input_type' => $this->input_type,
            'is_filterable' => $this->is_filterable,
            'is_required' => $this->is_required,
            'values' => ProductAttributeValueResource::collection($this->whenLoaded('values'))->implode('value', ','),
        ];
    }
}
