<?php

namespace App\Http\Controllers\Admin\Product;

use App\Constants\AdminConstant;
use App\Helpers\FileManageHelper;
use App\Http\Controllers\Admin\API\BaseController;
use App\Http\Controllers\Admin\Mixins\CommonDataController;
use App\Http\Requests\Products\ProductCreateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\ImageGallery;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use App\Models\ProductImageGallery;
use App\Models\ProductSubCategory;
use App\Models\ProductVariantCombination;
use App\Models\ProductVariation;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public object $user;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard(AdminConstant::ADMIN_GUARD)->user();

            return $next($request);
        });
    }

    public function index()
    {
        if (!$this->user->can('product read')) {
            return redirect()->route('admin.unauthorized');
        }

        if (request()->has('search-query')) {
            $searchQuery = request()->get('search-query');

            $products = Product::query()->with('value')
                ->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%')
                ->orWhere('slug', 'like', '%' . $searchQuery . '%')
                ->orWhere('category_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('sub_category_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('brand_name', 'like', '%' . $searchQuery . '%')
                ->orderBy('id', 'desc')
                ->paginate(20);
        } else {
            $products = Product::query()->with('value')->orderBy('id', 'desc')->paginate(20);
        }

        $count = Product::count();

        return view('admin.pages.products.pages.index', [
            'products' => $products ?? [],
            'productCount' => $count,
        ]);
    }

    public function create()
    {
        if (!$this->user->can('product create')) {
            return redirect()->route('admin.unauthorized');
        }

        return view('admin.pages.products.pages.create');
    }

    /**
     * @throws Exception
     */
    public function store(ProductCreateRequest $request)
    {
        $request->validated();

        $productData = [
            'vendor_id' => $request->vendor_id,
            'brand_id' => $request->brand_id,
            'brand_name' => Brand::find($request->brand_id)->name,
            'product_category_id' => $request->category_id,
            'category_name' => ProductCategory::find($request->category_id)->name,
            'product_sub_category_id' => $request->sub_category_id,
            'sub_category_name' => ProductSubCategory::find($request->sub_category_id)->name,
            'name' => $request->name,
            'description' => $request->description,
            'added_by' => $request->user()->email,
            'labels' => $request->labels,
            'is_featured' => $request->is_featured === 'true',
            'is_trending' => $request->is_trending === 'true',
            'is_active' => $request->is_active === 'true',
            'is_top_sale' => $request->is_top_sale === 'true',
        ];

        if ($request->condition) {
            $productData['condition'] = $request->condition;
        }

        if ($request->video_link && $request->video_link != 'null') {
            $productData['video_link'] = $request->video_link;
        }

        if ($request->hasFile('feature_image')) {
            $f_image_rl_path = FileManageHelper::upload($request->feature_image, 'products/images/feature/' . Str::random(8));
            $productData['featured_image'] = $f_image_rl_path;
        }

        $product = Product::create($productData);

        $attributes = $request->input('attributes') ?? [];

        foreach ($attributes as $attribute) {
            if (!empty($attribute['name']) && !empty($attribute['input_type'])) {
                $attrData = [
                    'name' => $attribute['name'],
                    'input_type' => $attribute['input_type'],
                ];
                $productAttribute = $product->attributes()->create($attrData);
                $attributeValues = $attribute['values'] ?? [];
                $attributeValues = explode(',', $attributeValues);
                foreach ($attributeValues as $attributeValue) {
                    $productAttribute->values()->create([
                        'value' => $attributeValue,
                    ]);
                }
            }
        }

        if (!$request->hasFile('feature_image') && $request->feature_image == null) {
            return $this->sendError('Feature image is required');
        }

        if ($request->images && $request->images['large_images']) {
            $large_images = $request->images['large_images'];

            foreach ($large_images as $index => $large_image) {
                $l_image_rl_path = FileManageHelper::upload($large_image, 'products/images/large/' . Str::random(8));
                $gallery = ImageGallery::create([
                    'large_image' => $l_image_rl_path,
                ]);

                if (!$request->hasFile('feature_image')) {
                    if ($index == 0) {
                        $product->featured_image = $gallery->large_image;
                        $product->update();
                    }
                }
                ProductImageGallery::create([
                    'product_id' => $product->id,
                    'image_gallery_id' => $gallery->id,
                ]);

            }
        }

        $productValues = [
            'product_id' => $product->id,
            'base_price' => $request->base_price,
            'sale_price' => $request->sale_price,
            'promo_price' => $request->promo_price,
            'sku' => $request->sku,
            'stock' => $request->stock,
            'moq' => $request->moq,
            'allow_coupon' => $request->allow_coupon === 'true',
            'advance_amount' => $request->advance_amount,
        ];

        $product->value()->create($productValues);

        if (isset($request->variant_options)) {
            $variantOptions = json_decode($request->variant_options, true) ?? [];

            foreach ($variantOptions as $variantOption) {
                $productVariant = ProductVariation::create([
                    'product_id' => $product->id,
                    'name' => $variantOption['name'],
                ]);

                foreach ($variantOption['values'] as $value) {
                    $productVariant->values()->create([
                        'value' => $value['name'],
                    ]);
                }
            }
        }

        if (isset($request->variant_combinations)) {
            $variantCombinations = json_decode($request->variant_combinations, true);

            foreach ($variantCombinations as $combination) {
                $combination['product_id'] = $product->id;
                ProductVariantCombination::create($combination);
            }
        }

        return $this->sendResponse($product, 'Product created successfully.');
    }

    public function show(Product $product)
    {
        if (!$this->user->can('product read')) {
            return redirect()->route('admin.unauthorized');
        }

        $product->load('value');
        $product->load('galleries.images');
        $product->loadMissing('attributes.values');
        $product->loadMissing('variations.values');
        $product->loadMissing('variantCombinations');

        return new ProductResource($product);
    }

    public function edit(Product $product): RedirectResponse|View
    {
        if (!$this->user->can('product create')) {
            return redirect()->route('admin.unauthorized');
        }

        return view('admin.pages.products.pages.edit', [
            'product' => $product,
        ]);
    }

    /**
     * @throws Exception
     */
    public function update(ProductCreateRequest $request, Product $product): JsonResponse
    {
        $request->validated();
        try {

            $productData = [
                'vendor_id' => $request->vendor_id,
                'brand_id' => $request->brand_id,
                'brand_name' => Brand::find($request->brand_id)->name,
                'product_category_id' => $request->category_id,
                'category_name' => ProductCategory::find($request->category_id)->name,
                'product_sub_category_id' => $request->sub_category_id,
                'sub_category_name' => ProductSubCategory::find($request->sub_category_id)->name,
                'name' => $request->name,
                'description' => $request->description,
                'added_by' => $request->user()->email,
                'labels' => $request->labels,
                'is_featured' => $request->is_featured === 'true',
                'is_trending' => $request->is_trending === 'true',
                'is_active' => $request->is_active === 'true',
                'is_top_sale' => $request->is_top_sale === 'true',
            ];

            if ($request->condition && $request->condition != 'null') {
                $productData['condition'] = $request->condition;
            }

            if ($request->video_link && $request->video_link != 'null') {
                $productData['video_link'] = $request->video_link;
            }

            if ($request->hasFile('feature_image')) {
                $f_image_rl_path = FileManageHelper::upload($request->feature_image, 'products/images/feature/' . Str::random(8));
                if ($product->featured_image) {
                    FileManageHelper::delete($product->featured_image);
                }
                $product->featured_image = $f_image_rl_path;
            }
            $product->update($productData);

            // save attributes and its values
            $attributes = $request->input('attributes') ?? [];

            foreach ($attributes as $attribute) {
                if (!empty($attribute['name']) && !empty($attribute['input_type'])) {
                    $attrData = [
                        'name' => $attribute['name'],
                        'input_type' => $attribute['input_type'],
                    ];
                    // this is for update, if attribute id is present then update otherwise create
                    if (isset($attribute['id'])) {
                        $productAttribute = ProductAttribute::find($attribute['id']);
                        $productAttribute->update($attrData);
                    } else {
                        $productAttribute = $product->attributes()->create($attrData);
                    }

                    if (isset($attribute['id'])) {
                        $productAttribute->values()->delete();
                    }

                    $attributeValues = $attribute['values'] ?? [];

                    $attributeValues = explode(',', $attributeValues);

                    foreach ($attributeValues as $attributeValue) {
                        $productAttribute->values()->create([
                            'value' => $attributeValue,
                        ]);
                    }
                }
            }

            $large_images = $request->images['large_images'] ?? null;

            if ($large_images) {
                foreach ($large_images as $index => $large_image) {
                    $l_image_rl_path = FileManageHelper::upload($large_image, 'products/images/large/' . Str::random(8));

                    $gallery = new ImageGallery();
                    $gallery->large_image = $l_image_rl_path;
                    $gallery->save();

                    if (!$request->hasFile('feature_image') && $request->feature_image == null) {
                        if ($index == 0) {
                            $product->featured_image = $gallery->large_image;
                            $product->save();
                        }
                    }

                    // also save the product image gallery
                    ProductImageGallery::create([
                        'product_id' => $product->id,
                        'image_gallery_id' => $gallery->id,
                    ]);
                }
            }

            $productValues = [
                'product_id' => $product->id,
                'base_price' => $request->base_price,
                'sale_price' => $request->sale_price,
                'promo_price' => $request->promo_price,
                'sku' => $request->sku,
                'stock' => $request->stock,
                'moq' => $request->moq,
                'allow_coupon' => $request->allow_coupon === 'true',
                'advance_amount' => $request->advance_amount,
            ];

            $product->value()->update($productValues);

            if (isset($request->variant_options)) {
                $variantOptions = json_decode($request->variant_options, true) ?? [];

                foreach ($variantOptions as $variantOption) {
                    if (isset($variantOption['id'])) {
                        $productVariant = ProductVariation::find($variantOption['id']);
                        $productVariant->update([
                            'name' => $variantOption['name'],
                        ]);
                    } else {
                        $productVariant = ProductVariation::create([
                            'product_id' => $product->id,
                            'name' => $variantOption['name'],
                        ]);
                    }

                    foreach ($variantOption['values'] as $value) {
                        if (isset($value['id'])) {
                            $productVariant->values()->find($value['id'])->update([
                                'value' => $value['name'],
                            ]);
                        } else {
                            $productVariant->values()->create([
                                'value' => $value['name'],
                            ]);
                        }
                    }
                }
            }

            if (isset($request->variant_combinations)) {
                $variantCombinations = json_decode($request->variant_combinations, true);

                $product->variantCombinations()->delete();

                foreach ($variantCombinations as $combination) {
                    $product->variantCombinations()->create($combination);
                }
            }

            return $this->sendResponse($product, 'Product updated successfully.');

        } catch (Exception $e) {
            return $this->sendError('Failed to update due to: ' . $e->getMessage(), '', 422);
        }
    }

    public function destroy(Product $product): RedirectResponse
    {
        if (!$this->user->can('product delete')) {
            return redirect()->route('admin.unauthorized');
        }

        if ($product->featured_image) {
            FileManageHelper::delete($product->featured_image);
        }

        foreach ($product->galleries as $gallery) {
            if ($gallery->images) {
                (new CommonDataController())->deleteImage($gallery->images->id);
            }
        }

        foreach ($product->variations as $variation) {
            $variation->values()->delete();
            $variation->delete();
        }

        $product->variantCombinations()->delete();

        if ($product->delete()) {
            return back()->with('success', 'Product deleted successfully');
        }

        return back()->with('error', 'Unable to delete product');
    }

    public function deleteAttribute(Product $product, ProductAttribute $attribute): JsonResponse
    {
        $attribute->delete();

        return $this->sendResponse([], 'Attribute deleted successfully.');
    }

    public function duplicate(Product $product): RedirectResponse
    {
        $newProduct = $product->replicate();
        $newProduct->name = $product->name . ' - Copy';
        $newProduct->slug = $product->slug . '-copy';

        if ($product->featured_image) {
            $newProduct->featured_image = FileManageHelper::duplicate($product->featured_image, 'products/images/feature/' . Str::random(8));
        }
        $newProduct->save();

        $newProduct->value()->create([
            'product_id' => $newProduct->id,
            'base_price' => $product->value->base_price,
            'sale_price' => $product->value->sale_price,
            'promo_price' => $product->value->promo_price,
            'sku' => $product->value->sku,
            'stock' => $product->value->stock,
            'moq' => $product->value->moq,
            'allow_coupon' => $product->value->allow_coupon,
        ]);

        foreach ($product->attributes as $attribute) {
            $newAttribute = $attribute->replicate();
            $newAttribute->product_id = $newProduct->id;
            $newAttribute->save();

            foreach ($attribute->values as $value) {
                $newValue = $value->replicate();
                $newValue->product_attribute_id = $newAttribute->id;
                $newValue->save();
            }
        }

        foreach ($product->galleries as $gallery) {
            $newImageGallery = $gallery->images->replicate();

            // need to duplicate the image in aws s3 also
            $replicatedLargeImage = FileManageHelper::duplicate($gallery->images->large_image, 'products/images/large/' . Str::random(8));
            $newImageGallery->large_image = $replicatedLargeImage;

            $newImageGallery->save();

            $newGallery = $gallery->replicate();
            $newGallery->product_id = $newProduct->id;
            $newGallery->image_gallery_id = $newImageGallery->id;
            $newGallery->save();

        }

        foreach ($product->variations as $variation) {
            $newVariation = $variation->replicate();
            $newVariation->product_id = $newProduct->id;
            $newVariation->save();

            foreach ($variation->values as $value) {
                $newValue = $value->replicate();
                $newValue->product_variation_id = $newVariation->id;
                $newValue->save();
            }
        }

        foreach ($product->variantCombinations as $combination) {
            $newCombination = $combination->replicate();
            $newCombination->product_id = $newProduct->id;
            $newCombination->save();
        }

        return back()->with('success', 'Product duplicated successfully.');
    }
}
