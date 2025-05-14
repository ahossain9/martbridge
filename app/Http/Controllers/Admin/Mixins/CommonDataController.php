<?php

namespace App\Http\Controllers\Admin\Mixins;

use App\Helpers\FileManageHelper;
use App\Http\Controllers\Admin\API\BaseController;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\ProductLabelApiResource;
use App\Models\Brand;
use App\Models\ImageGallery;
use App\Models\ProductCategory;
use App\Models\ProductLabel;
use App\Models\ProductSubCategory;
use App\Models\ProductVariantCombination;
use App\Models\ProductVariation;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class CommonDataController extends BaseController
{
    public function categories(): JsonResponse
    {
        $categories = ProductCategory::all();

        return $this->sendResponse($categories, 'Categories retrieved successfully.');
    }

    public function subCategories(string $id): JsonResponse
    {
        $subCategories = ProductCategory::find($id)->productSubCategories;

        return $this->sendResponse($subCategories, 'Sub Categories retrieved successfully.');
    }

    public function attributes(string $id): JsonResponse
    {
        $attributes = ProductSubCategory::find($id)->productAttributes;

        return $this->sendResponse(AttributeResource::collection($attributes), 'Attributes retrieved successfully.');
    }

    public function brands(): JsonResponse
    {
        $brands = Brand::where('is_active', true)->get();

        return $this->sendResponse($brands, 'Brands retrieved successfully.');
    }

    public function vendors(): JsonResponse
    {
        $vendors = Vendor::where('is_active', true)->get();

        return $this->sendResponse($vendors, 'Vendors retrieved successfully.');
    }

    public function productLabels(): JsonResponse
    {
        $labels = ProductLabel::where('is_active', true)->get();

        return $this->sendResponse(ProductLabelApiResource::collection($labels), 'Labels retrieved successfully.');
    }

    public function deleteImage(string $id): JsonResponse
    {
        $image = ImageGallery::find($id);

        if ($image && $image->large_image) {
            FileManageHelper::delete($image->large_image);
            $image->delete();

            return $this->sendResponse([], 'Image deleted successfully.');
        }

        return $this->sendError('Image not found.');
    }

    public function deleteVariantCombination(string $id): JsonResponse
    {
        $variantCombination = ProductVariantCombination::find($id);

        if ($variantCombination) {
            $variantCombination->delete();

            return $this->sendResponse([], 'Variant combination deleted successfully.');
        }

        return $this->sendError('Variant combination not found.');
    }

    public function deleteVariantOption(string $id): JsonResponse
    {
        $variantOption = ProductVariation::find($id);

        if ($variantOption) {
            $variantOption->values()->delete();
            $variantOption->delete();

            return $this->sendResponse([], 'Variant option deleted successfully.');
        }

        return $this->sendError('Variant option not found.');
    }
}
