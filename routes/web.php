<?php

use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\UserAccountController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'HtmlMinifier'], function () {

    Route::get('/', [PagesController::class, 'index'])->name('frontend.dashboard');
    Route::get('/about-us', [PagesController::class, 'about'])->name('frontend.about');
    Route::get('/contact-us', [PagesController::class, 'contact'])->name('frontend.contact');
    Route::post('/contact-us', [PagesController::class, 'submitContact'])->name('frontend.contact.submit');
    Route::get('/faq', [PagesController::class, 'faq'])->name('frontend.faq');
    Route::get('/privacy-policy', [PagesController::class, 'privacy'])->name('frontend.privacy');
    Route::get('/terms-conditions', [PagesController::class, 'terms'])->name('frontend.terms');

    Route::group(['as' => 'frontend.auth.'], function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
        // logout
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

        Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
            Route::get('/', [UserAccountController::class, 'index'])->name('index');
        });
    });

    Route::group(['prefix' => 'shop', 'as' => 'frontend.shop.'], function () {
        Route::get('/', [ShopController::class, 'index'])->name('index');
        Route::get('/{slug}', [ShopController::class, 'product'])->name('product');
    });

    Route::get('/wishlist', [ShopController::class, 'wishlist'])->name('frontend.shop.wishlist');
    Route::get('/cart', [ShopController::class, 'cart'])->name('frontend.products.cart');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('frontend.products.checkout');
    Route::post('/checkout', [CheckoutController::class, 'postCheckout'])->name('frontend.products.checkout.submit');

    Route::get('/search', [ShopController::class, 'search'])->name('frontend.products.search');

});

Route::get('/product-quick-view/{slug}', [PagesController::class, 'quickView'])->name('product.quickview');
