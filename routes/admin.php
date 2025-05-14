<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CRM\ContactRequestController;
use App\Http\Controllers\Admin\CRM\NewsletterSubscriberController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\Mixins\CommonDataController;
use App\Http\Controllers\Admin\Orders\OrderController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\Product\AttributeController;
use App\Http\Controllers\Admin\Product\AttributeValueController;
use App\Http\Controllers\Admin\Product\CategoryController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ProductLabelController;
use App\Http\Controllers\Admin\Product\SubCategoryController;
use App\Http\Controllers\Admin\Sliders\SliderController;
use App\Http\Controllers\Admin\Store\BrandController;
use App\Http\Controllers\Admin\UserManage\AdminUserController;
use App\Http\Controllers\Admin\UserManage\PermissionController;
use App\Http\Controllers\Admin\UserManage\RoleController;
use App\Http\Controllers\Admin\Vendor\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['as' => 'admin.'], function () {
    //auth routes
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [LoginController::class, 'showAdminLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'adminLogin'])->name('login.submit');
        Route::post('logout', [LoginController::class, 'adminLogout'])->name('logout');
    });
    Route::get('/dashboard', [PagesController::class, 'index'])->name('dashboard');
    Route::group(['middleware' => 'auth:admin'], function () {
        //roles routes
        Route::group(['prefix' => 'user-manage', 'as' => 'user_manage.'], function () {
            Route::resource('/roles', RoleController::class);

            Route::resource('/permissions', PermissionController::class);
            Route::resource('/users', AdminUserController::class);
        });

        Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
            Route::resource('/vendors', VendorController::class);
            Route::resource('/brands', BrandController::class);
        });

        Route::resource('/sliders', SliderController::class);

        //products routes
        Route::group(['prefix' => 'manage-products', 'as' => 'product_manage.'], function () {
            Route::resource('/categories', CategoryController::class);
            Route::resource('/sub-categories', SubCategoryController::class)->names('sub_categories');
            Route::resource('/attributes', AttributeController::class);
            Route::resource('/labels', ProductLabelController::class);
            Route::get('/attribute-values/{variant_id}', [AttributeValueController::class, 'index']);
            Route::post('/attribute-values', [AttributeValueController::class, 'store']);
            Route::delete('/attribute-values/{id}', [AttributeValueController::class, 'destroy']);

            // products routes

            Route::resource('/products', ProductController::class);
            Route::get('/products/{product}/duplicate', [ProductController::class, 'duplicate'])->name('products.duplicate');
            // delete attributes of product
            Route::delete('/products/{product}/attributes/{attribute}', [ProductController::class, 'deleteAttribute'])->name('products.delete_attribute');
        });

        Route::group(['prefix' => 'manage-orders', 'as' => 'manage_orders.'], function () {
            Route::resource('/orders', OrderController::class);
            Route::get('/invoice/{order}', [OrderController::class, 'printInvoice'])->name('invoice.print');
            Route::post('/update-status/{order}', [OrderController::class, 'updateStatus'])->name('update.status');
            Route::post('/update-price/{order}', [OrderController::class, 'updatePrice'])->name('update.price');
        });

        Route::group(['prefix' => 'manage-customers', 'as' => 'manage_customer.'], function () {
            Route::resource('/customers', CustomerController::class);
        });

        // mixin routes
        Route::group(['prefix' => 'mixin', 'as' => 'mixin.'], function () {
            Route::get('/categories', [CommonDataController::class, 'categories'])->name('mixin.categories');
            Route::get('/sub-categories/{id}', [CommonDataController::class, 'subCategories'])->name('mixin.subcategories');
            Route::get('/get-attributes/{id}', [CommonDataController::class, 'attributes'])->name('mixin.attributes');
            Route::get('/get-brands', [CommonDataController::class, 'brands'])->name('mixin.brands');
            Route::get('/get-vendors', [CommonDataController::class, 'vendors'])->name('mixin.vendors');
            Route::get('/get-labels', [CommonDataController::class, 'productLabels'])->name('mixin.labels');

            Route::delete('/delete-image/{id}', [CommonDataController::class, 'deleteImage'])->name('mixin.delete_image');
            Route::delete('/delete-variant-option/{id}', [CommonDataController::class, 'deleteVariantOption'])
                ->name('mixin.delete_variant_option');
            Route::delete('/delete-variant-combination/{id}', [CommonDataController::class, 'deleteVariantCombination'])
                ->name('mixin.delete_variant_combination');
        });

        // root pages
        Route::get('/', [PagesController::class, 'index'])->name('index');

        // chartjs
        Route::get('/top-selling-items', [PagesController::class, 'topSellingItems'])
            ->name('top_selling_items');

        //CRM
        Route::group(['prefix' => 'crm', 'as' => 'crm.'], function () {
            Route::resource('/contact-requests', ContactRequestController::class)->names('contact_requests');
            Route::get('/contact-requests/{id}/mark-as-replied', [ContactRequestController::class, 'markAsReplied'])
                ->name('contact_requests.mark_as_replied');

            Route::resource('/newsletter-subscriber', NewsletterSubscriberController::class)
                ->names('newsletter_subscriber');
        });
        Route::get('/unauthorized', [PagesController::class, 'unauthorized'])->name('unauthorized');
    });
});
