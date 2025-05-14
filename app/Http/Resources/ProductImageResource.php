<?php

namespace App\Http\Resources;

use App\Helpers\FileManageHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
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
            'large_image' => FileManageHelper::getS3FileUrl($this->large_image),
        ];
    }
}
