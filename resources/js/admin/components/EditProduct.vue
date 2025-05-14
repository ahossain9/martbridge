<template>
    <Spinner v-if="fetching"/>
    <form v-else method="post" class="needs-validation p-2" @submit.prevent="save" novalidate>
        <div>
            <div v-for="(err) in errors">
                <p class="text-danger">{{ err[0] }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" style="margin-right: 6px;" for="helpInputTop">Choose Vendor</label>
                    <select class="form-select"
                            v-model="product_form.vendor_id"
                            name="vendor_id" required>
                        <option value="">Choose vendor</option>
                        <option
                            v-for="(vendor, index) in vendors"
                            :key="index"
                            :value="vendor.id">{{ vendor.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" v-model="product_form.name"
                           placeholder="ex: Example Product" required/>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" style="margin-right: 6px;" for="helpInputTop">Product Slug</label>
                    <small class="text-muted"><i>help to get on search</i></small>
                    <input type="text" class="form-control" id="helpInputTop" v-model="product_form.slug"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="sub_category_id">Choose Brand*</label>
                    <a class="font-small-1" href="/admin/store/brands" target="_blank"><i>Add New</i></a>
                    <select class="form-select"
                            v-model="product_form.brand_id"
                            name="brand_id" required>
                        <option value="">Choose product Brand</option>
                        <option
                            v-for="(brand, index) in brands"
                            :key="index"
                            :value="brand.id">{{ brand.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="category_id">Choose Category*</label>
                    <a class="font-small-1" href="/admin/manage-products/categories" target="_blank"><i>Add New</i></a>
                    <select class="form-select" id="category_id" name="category_id"
                            @change="getSubCategories"
                            v-model="product_form.category_id"
                            required>
                        <option value="">Choose product category</option>
                        <option
                            v-for="(category, index) in categories"
                            :key="index"
                            :value="category.id">{{ category.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="sub_category_id">Choose Subcategory*</label>
                    <a class="font-small-1" href="/admin/manage-products/sub-categories" target="_blank"><i>Add New</i></a>
                    <select class="form-select"
                            v-model="product_form.sub_category_id"
                            @change="getAttributes"
                            id="sub_category_id" name="sub_category_id" required>
                        <option value="">Choose product Subcategory</option>
                        <option
                            v-for="(sub_category, index) in sub_categories"
                            :key="index"
                            :value="sub_category.id">{{ sub_category.name }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="sku">SKU *</label>
                    <small class="text-muted"><i>Unique identifier of your product</i></small>
                    <input type="text" class="form-control" id="sku" v-model="product_form.sku"
                           placeholder="XYABDGI"/>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="sku">Stock *</label>
                    <small class="text-muted"><i>How many items in your stock</i></small>
                    <input type="number" class="form-control" id="sku" v-model="product_form.stock"
                           placeholder="10"/>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="sku">Minimum Number Of Quantity (Moq) *</label>
                    <input type="number" class="form-control" id="sku" v-model="product_form.moq"
                           placeholder="10"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="product_base_price">Base Price</label>
                    <input type="number" class="form-control" id="product_base_price" v-model="product_form.base_price"
                           placeholder="100.50"/>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="product_sale_price">Sale Price *</label>
                    <input type="number" class="form-control" id="product_sale_price" v-model="product_form.sale_price"
                           placeholder="100.50"/>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="product_promo_price">Promo Price</label>
                    <small class="text-muted"><i>If product has promo price offer</i></small>
                    <input type="number" class="form-control" id="product_promo_price"
                           v-model="product_form.promo_price" placeholder="100.50"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-6 col-12 mb-1">
                <label class="form-label" for="video_link">Video Link </label>
                <input type="text" class="form-control" id="video_link" v-model="product_form.video_link"
                       placeholder="https://youtube.com/your_video_link"/>
            </div>
            <div class="col-xl-6 col-md-6 col-12 mb-1">
                <label class="form-label" for="product_label">Product Labels * </label>
                <VueMultiselect
                    v-model="product_form.labels"
                    :options="productLabelOptions"
                    :multiple="true"
                    track-by="id" label="name"
                    placeholder="Please select product labels">
                </VueMultiselect>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-md-8 col-12">
                <div class="mb-1">
                    <label class="form-label" for="sub_category_id">Product condition or source (Ex: Official,
                        UnOfficial, Pre-owned)</label>
                    <a class="font-small-1" href="/admin/store/brands" target="_blank"><i>Add New</i></a>
                    <select class="form-select"
                            v-model="product_form.condition"
                            name="product_condition_id" required>
                        <option value="">None</option>
                        <option
                            v-for="(condition, index) in productConditions"
                            :key="index"
                            :value="condition.value">{{ condition.name }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 col-12 mb-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_advance_payment"
                           name="is_advance_payment" tabindex="3" v-model="product_form.is_advance_payment"/>
                    <label class="form-check-label" for="is_advance_payment"> Get Advance Payment </label>
                </div>
            </div>
        </div>
        <div
            v-if="product_form.is_advance_payment"
            class="row">
            <div class="col-xl-6 col-md-6 col-12">
                <div class="mb-1">
                    <label class="form-label" for="advance_payment">Product advance payment</label>
                    <input type="number" class="form-control" id="advance_payment"
                           v-model="product_form.advance_amount"/>
                </div>
            </div>
        </div>

        <!-- Product Attribute Area-->
        <div class="border p-1 mb-2">
            <div class="d-flex align-items-center">
                <label class="form-label me-2" for="option_value"><strong>Product Attributes</strong></label>
                <button class="btn-sm btn-outline-info text-nowrap" style="margin-right: 5px;" type="button"
                        @click="addProductAttribute">
                    Add
                </button>
            </div>
            <hr>
            <div class="row d-flex align-items-end border-bottom pb-1 mb-1"
                 v-for="(attribute, index) in product_form.attributes"
                 :key="index"
            >
                <div class="col-md-10 col-12">
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="form-label" for="attribute_name-{{index+1}}">Name</label>
                            <input type="text" class="form-control" for="attribute_name-{{index+1}}"
                                   v-model="attribute.name" placeholder="ex: Color"/>
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="attribute_input_type-{{index+1}}">Input Type</label>
                            <select class="form-select" id="attribute_input_type-{{index+1}}"
                                    v-model="attribute.input_type">
                                <option value="">Input Type</option>
                                <option value="select">Select</option>
                                <option value="radio">Radio</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="text">Text</option>
                            </select>
                        </div>
                        <div class="col-md-7 col-12">
                            <label class="form-label" for="attribute_values-{{index+1}}">Values (separated by
                                comma(,))</label>
                            <input type="text" class="form-control" for="attribute_values-{{index+1}}"
                                   v-model="attribute.values" placeholder="ex: Color"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-12 d-flex align-items-center mt-1">
                    <button class="btn-sm btn-outline-info text-nowrap" style="margin-right: 5px;" type="button"
                            @click="addProductAttribute">
                        Add
                    </button>
                    <button class="btn-sm btn-outline-danger text-nowrap" type="button"
                            @click="removeProductAttribute(index)"
                    >
                        Remove
                    </button>
                </div>
            </div>
        </div>
        <!-- End Product Attribute Area-->

        <div class="row">
            <div class="col-xl-6 col-md-6 col-12 mb-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                           name="allow_coupon" tabindex="3" v-model="product_form.allow_coupon"/>
                    <label class="form-check-label" for="allow_coupon"> Allow coupon for this product </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <DraggableSingleFileUploader label="Product Featured Image"
                                             :image="product_form.feature_image"
                                             @upload-finished="handleFeaturedImageUpload"
                                             @file-deleted="handleFileDeleted"/>
            </div>
        </div>

        <CKEditor :editor_value="product_form.description" label="Product Description"
                  @update_editor_text="updateProductDescription"/>

        <div class="row">

            <div class="col-xl-6 col-md-6 col-12 mb-2">
                <DraggableUpload :images="product_form.images.large_images" label="Product Gallery Images (580x472) *"
                                 @upload-finished="uploadedProductLargeImages"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div
                    v-if="product_images.length > 0"
                    v-for="(image, index) in product_images" :key="index" class="">
                    <div class="d-flex justify-content-between mb-1">
                        <img :src="image.large_image" class="" alt="Image" width="100">
                        <div class="card-body">
                            <button type="button" @click="removeImage(image, index)"
                                    class="btn-sm btn-danger cursor-pointer">
                                X
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-xl-4 col-md-4 col-12 mb-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_advance_Variant"
                           name="is_advance_Variant" tabindex="3" v-model="isAdvanceVariant"/>
                    <label class="form-check-label" for="is_advance_Variant"> Setup Advance Variant </label>
                </div>
            </div>
        </div>

        <Variation
            v-if="isAdvanceVariant"
            :salePrice="product_form.sale_price"
            :variantOptions="variantOptions"
            :variantsCombinations="variantsCombinations"
            @update:variantOptions="updateVariantOptions"
            @update:variantsCombinations="updateVariantsCombinations"
        />

        <div class="row  mb-1">
            <div class="col-xl-3 col-md-3 col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                           name="is_active" tabindex="3" v-model="product_form.is_active"/>
                    <label class="form-check-label" for="is_active"> Active </label>
                </div>
            </div>
            <div class="col-xl-3 col-md-3 col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                           name="is_featured" tabindex="3" v-model="product_form.is_featured"/>
                    <label class="form-check-label" for="is_featured"> Featured </label>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                           name="is_trending" tabindex="3" v-model="product_form.is_trending"/>
                    <label class="form-check-label" for="is_trending"> Trending </label>
                </div>
            </div>
            <div class="col-xl-3 col-md-3 col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                           name="is_top_sale" tabindex="3" v-model="product_form.is_top_sale"/>
                    <label class="form-check-label" for="is_top_sale"> Top Sale </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-1 me-1 col-12">
                <div class="mb-1">
                    <button class="btn btn-outline-info text-nowrap px-1 waves-effect" type="submit"
                            :disabled="loading"
                    >
                        <span v-if="loading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        <span v-else>Save</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>

import {ref, onMounted} from 'vue';
import VueMultiselect from "vue-multiselect";
import axiosClient from "../../axios";

import DraggableUpload from "./Core/DraggableUpload.vue";
import CKEditor from "./Core/CKEditor.vue";
import Spinner from "./Core/Spinner.vue";
import DraggableSingleFileUploader from "./Core/DraggableSingleFileUploader.vue";
import Variation from "./Product/Partials/Variation.vue";

const props = defineProps({
    product_id: {
        type: Number
    }
});

const vendors = ref(null);
const categories = ref(null);
const sub_categories = ref(null);
const brands = ref(null);
const attributes = ref(null);
const productLabelOptions = ref([]);
const productConditions = [
    {name: 'Official', value: 'official'},
    {name: 'UnOfficial', value: 'unofficial'},
    {name: 'Pre-owned', value: 'pre-owned'},
];
const errors = ref([]);
const isAdvanceVariant = ref(false);

const fetching = ref(false);
const loading = ref(false);

const product_form = ref({
    name: '',
    slug: '',
    vendor_id: '',
    brand_id: '',
    category_id: '',
    sub_category_id: '',
    description: '',
    is_active: true,
    sku: '',
    stock: 0,
    moq: 1,
    base_price: 0,
    sale_price: 0,
    promo_price: 0,
    discount: 0,
    video_link: '',
    label: '',
    labels: [],
    condition: '',
    feature_image: null,
    attributes: [{
        id: '',
        name: '',
        input_type: 'select',
        values: '',
    }],
    is_featured: false,
    is_trending: false,
    is_top_sale: false,
    allow_coupon: false,
    is_advance_payment: false,
    advance_amount: 0,
    images: {
        medium_images: [],
        large_images: [],
    },
})

let product_images = ref([]);

const variantOptions = ref([]);
const variantsCombinations = ref([]);

const updateVariantOptions = (updatedOptions) => {
    variantOptions.value = updatedOptions;
}

const updateVariantsCombinations = (updatedCombinations) => {
    variantsCombinations.value = updatedCombinations;
}

onMounted(() => {
    getVendors();
    getCategories();
    getBrands();
    getProduct();
    getLabels();
    document.getElementById('product_name').focus();
});

const handleFeaturedImageUpload = (image) => {
    product_form.value.feature_image = image;
}

const handleFileDeleted = (image) => {
    product_form.value.feature_image = null;
}

const getProduct = async () => {
    if (!props.product_id) {
        return;
    }

    try {
        fetching.value = true;
        const response = await axiosClient.get('manage-products/products/' + props.product_id);
        let product = response.data.data;

        // set the product form
        product_form.value.name = product.name;
        product_form.value.slug = product.slug;
        product_form.value.vendor_id = product.vendor_id;
        product_form.value.brand_id = product.brand_id;
        product_form.value.category_id = product.category_id;
        await getSubCategories();
        product_form.value.sub_category_id = product.sub_category_id;
        product_form.value.description = product.description == null ? '' : product.description;
        product_form.value.video_link = product.video_link;
        product_form.value.is_active = !!product.is_active;
        product_form.value.is_featured = !!product.is_featured;
        product_form.value.is_trending = !!product.is_trending;
        product_form.value.is_top_sale = !!product.is_top_sale;
        product_form.value.label = product.label;
        product_form.value.feature_image = product.featured_image;
        product_form.value.sku = product.value?.sku;
        product_form.value.stock = product.value?.stock;
        product_form.value.moq = product.value?.moq;
        product_form.value.base_price = product.value?.base_price;
        product_form.value.sale_price = product.value?.sale_price;
        product_form.value.promo_price = product.value?.promo_price;
        product_form.value.allow_coupon = !!product.value?.allow_coupon;
        product_form.value.labels = product.labels;
        product_form.value.condition = product.condition;

        if (product.value?.advance_amount > 0) {
            product_form.value.is_advance_payment = true;
            product_form.value.advance_amount = product.value?.advance_amount;
        }

        product_images.value = product.gallery.map((gl) => {
            return {
                id: gl.images.id,
                large_image: gl.images.large_image,
            }
        });

        if (product.attributes.length > 0) {
            product_form.value.attributes = product.attributes.map((attr) => {
                return {
                    id: attr.id,
                    name: attr.name,
                    input_type: attr.input_type,
                    values: attr.values,
                }
            });
        }

        if (product.variations.length > 0) {
            isAdvanceVariant.value = true;
            variantOptions.value = product.variations.map(item => ({
                id: item.id,
                name: item.name,
                values: item.values.map(valueItem => ({
                    id: valueItem.id,
                    product_variation_id: valueItem.product_variation_id,
                    name: valueItem.value,
                }))
            }));
        }

        if (product.variation_combinations.length > 0) {
            variantsCombinations.value = product.variation_combinations;
        }

        fetching.value = false;
    } catch (e) {
        errors.value = e.response.data.errors;
        fetching.value = false;
    }
}

const getCategories = async () => {
    try {
        fetching.value = true;
        const response = await axiosClient.get('mixin/categories');
        categories.value = response.data.data;
        fetching.value = false;
    } catch (e) {
        errors.value = e.response.data.errors;
        fetching.value = false;
    }
}

const getSubCategories = async () => {
    try {
        const response = await axiosClient.get('mixin/sub-categories/' + product_form.value.category_id);
        sub_categories.value = response.data.data;
    } catch (e) {
        console.log(e)
    }
}

const getVendors = async () => {
    try {
        fetching.value = true;
        const response = await axiosClient.get('mixin/get-vendors');
        vendors.value = response.data.data;
        fetching.value = false;
    } catch (e) {
        fetching.value = false;
        console.log(e)
    }
}

const getBrands = async () => {
    try {
        fetching.value = true;
        const response = await axiosClient.get('mixin/get-brands/');
        brands.value = response.data.data;
        fetching.value = false;
    } catch (e) {
        fetching.value = false;
        console.log(e)
    }
}

const getLabels = async () => {
    try {
        fetching.value = true;
        const response = await axiosClient.get('mixin/get-labels');
        productLabelOptions.value = response.data.data;

        fetching.value = false;
    } catch (e) {
        fetching.value = false;
    }
}

const getAttributes = async () => {
    try {
        const response = await axiosClient.get('mixin/get-attributes/' + product_form.value.sub_category_id);
        attributes.value = response.data.data;
    } catch (e) {
        console.log(e)
    }
}

const uploadedProductLargeImages = (images) => {
    product_form.value.images.large_images = images;
}

const updateProductDescription = (description) => {
    product_form.value.description = description;
}

const appendFiles = (formData, key, files) => {
    for (let file of files) {
        formData.append(key, file)
    }
}

// prepare form data
const prepareFormData = () => {
    const formData = new FormData();

    appendFiles(formData, 'images[large_images][]', product_form.value.images.large_images);

    formData.append('name', product_form.value.name);
    formData.append('slug', product_form.value.slug);
    formData.append('vendor_id', product_form.value.vendor_id);
    formData.append('brand_id', product_form.value.brand_id);
    formData.append('category_id', product_form.value.category_id);
    formData.append('sub_category_id', product_form.value.sub_category_id);
    formData.append('description', product_form.value.description);
    formData.append('sku', product_form.value.sku);
    formData.append('stock', product_form.value.stock);
    formData.append('moq', product_form.value.moq);
    formData.append('base_price', product_form.value.base_price);
    formData.append('sale_price', product_form.value.sale_price);
    formData.append('promo_price', product_form.value.promo_price);
    formData.append('is_featured', product_form.value.is_featured);
    formData.append('is_trending', product_form.value.is_trending);
    formData.append('is_top_sale', product_form.value.is_top_sale);
    formData.append('allow_coupon', product_form.value.allow_coupon);
    formData.append('video_link', product_form.value.video_link);
    formData.append('condition', product_form.value.condition);
    formData.append('label', product_form.value.label);
    for (let i = 0; i < product_form.value.labels.length; i++) {
        formData.append('labels[' + i + '][id]', product_form.value.labels[i].id);
        formData.append('labels[' + i + '][name]', product_form.value.labels[i].name);
    }
    formData.append('allow_coupon', product_form.value.allow_coupon);

    for (let i = 0; i < product_form.value.attributes.length; i++) {
        if (product_form.value.attributes[i].id) {
            formData.append('attributes[' + i + '][id]', product_form.value.attributes[i].id);
        }
        formData.append('attributes[' + i + '][name]', product_form.value.attributes[i].name);
        formData.append('attributes[' + i + '][input_type]', product_form.value.attributes[i].input_type);
        formData.append('attributes[' + i + '][values]', product_form.value.attributes[i].values);
    }

    formData.append('feature_image', product_form.value.feature_image);
    formData.append('is_active', product_form.value.is_active);
    formData.append('is_advance_payment', product_form.value.is_advance_payment);
    formData.append('advance_amount', product_form.value.advance_amount);

    formData.append('variant_options', JSON.stringify(variantOptions.value));
    formData.append('variant_combinations', JSON.stringify(variantsCombinations.value));

    formData.append('_method', 'PUT');
    return formData;
}

const save = async () =>
{
    const requiredFields = ['name', 'vendor_id', 'brand_id', 'category_id', 'feature_image', 'sub_category_id', 'stock', 'moq', 'sale_price']
    const isAnyFieldEmpty = requiredFields.some(field => !product_form.value[field]);

    if (isAnyFieldEmpty) {
        const emptyFields = requiredFields.filter(field => !product_form.value[field]);
        const errorMessage = emptyFields.join(', ') + ' is required!';
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errorMessage,
        });
        return false;
    }

    try {
        loading.value = true;

        await axiosClient.post(`manage-products/products/${props.product_id}`, prepareFormData(), {
            _method: 'PUT',
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        loading.value = false;

        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Product has been updated successfully!',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/admin/manage-products/products';
            }
        });
    } catch (error) {
        errors.value = error.response.data.errors;
        loading.value = false;

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        });
    }
}

const removeImage = (image, index) => {
    Swal.fire({
        title: 'Are you sure to remove this image?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axiosClient.delete('mixin/delete-image/' + image.id)
                .then((response) => {
                    Swal.fire(
                        'Deleted!',
                        'Image has deleted successfully.',
                        'success'
                    );

                    product_images.value.splice(index, 1);
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                })
        }
    })
}

const addProductAttribute = () => {
    product_form.value.attributes.push({
        name: '',
        input_type: 'select',
        values: '',
    });
}

const removeProductAttribute = (index) => {
    let attributeId = product_form.value.attributes[index]?.id;
    let productId = props?.product_id;

    Swal.fire({
        title: 'Are you sure to remove this attribute?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            if (attributeId) {
                axiosClient.delete('manage-products/products/' + productId + '/attributes/' + attributeId)
                    .then((response) => {
                        product_form.value.attributes.splice(index, 1);
                        Swal.fire(
                            'Deleted!',
                            'Attribute has deleted successfully.',
                            'success'
                        );
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    })
            } else {
                product_form.value.attributes.splice(index, 1);
            }
        }
    })
}

</script>


