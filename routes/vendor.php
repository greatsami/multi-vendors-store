<?php

use App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Route;

/** Vendor Routes */
Route::get('/dashboard', [Backend\VendorController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [Backend\VendorProfileController::class, 'index'])->name('profile');
Route::put('/profile', [Backend\VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile', [Backend\VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

Route::resource('shop-profile', Backend\VendorShopProfileController::class);

Route::get('products/get-sub-categories', [Backend\VendorProductController::class, 'getSubCategories'])->name('products.get-sub-categories');
Route::get('products/get-child-categories', [Backend\VendorProductController::class, 'getChildCategories'])->name('products.get-child-categories');
Route::put('products/change-status', [Backend\VendorProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('products', Backend\VendorProductController::class);

Route::resource('product-galleries', Backend\VendorProductImageGalleryController::class);

Route::put('product-variants/change-status', [Backend\VendorProductVariantController::class, 'changeStatus'])->name('product-variants.change-status');
Route::resource('product-variants', Backend\VendorProductVariantController::class);

Route::get('product-variant-items/{productId}/{variantId}/index', [Backend\VendorProductVariantItemController::class, 'index'])->name('product-variant-items.index');
Route::get('product-variant-items/{productId}/{variantId}/create', [Backend\VendorProductVariantItemController::class, 'create'])->name('product-variant-items.create');
Route::put('product-variant-items/change-status', [Backend\VendorProductVariantItemController::class, 'changeStatus'])->name('product-variant-items.change-status');
Route::resource('product-variant-items', Backend\VendorProductVariantItemController::class)->except('index', 'create');
