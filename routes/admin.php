<?php

use App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Route;

/** Admin Routes */
Route::get('/dashboard', [Backend\AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [Backend\ProfileController::class, 'index'])->name('profile');
Route::patch('/profile/update', [Backend\ProfileController::class, 'updateProfile'])->name('update.profile');
Route::patch('/profile/update/password', [Backend\ProfileController::class, 'updatePassword'])->name('update.password');

/** Slider Routes */
Route::resource('sliders', Backend\SliderController::class);

Route::put('categories/change-status', [Backend\CategoryController::class, 'changeStatus'])->name('categories.change-status');
Route::resource('categories', Backend\CategoryController::class);

Route::put('sub-categories/change-status', [Backend\SubCategoryController::class, 'changeStatus'])->name('sub-categories.change-status');
Route::resource('sub-categories', Backend\SubCategoryController::class);

Route::put('child-categories/change-status', [Backend\ChildCategoryController::class, 'changeStatus'])->name('child-categories.change-status');
Route::get('child-categories/get-sub-categories', [Backend\ChildCategoryController::class, 'getSubCategories'])->name('child-categories.get-sub-categories');
Route::resource('child-categories', Backend\ChildCategoryController::class);

Route::put('brands/change-status', [Backend\BrandController::class, 'changeStatus'])->name('brands.change-status');
Route::resource('brands', Backend\BrandController::class);

Route::resource('vendors', Backend\AdminVendorProfileController::class);

Route::get('products/get-sub-categories', [Backend\ProductController::class, 'getSubCategories'])->name('products.get-sub-categories');
Route::get('products/get-child-categories', [Backend\ProductController::class, 'getChildCategories'])->name('products.get-child-categories');
Route::put('products/change-status', [Backend\ProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('products', Backend\ProductController::class);

Route::resource('product-galleries', Backend\ProductImageGalleryController::class);

Route::put('product-variants/change-status', [Backend\ProductVariantController::class, 'changeStatus'])->name('product-variants.change-status');
Route::resource('product-variants', Backend\ProductVariantController::class);

Route::get('product-variant-items/{productId}/{variantId}/index', [Backend\ProductVariantItemController::class, 'index'])->name('product-variant-items.index');
Route::get('product-variant-items/{productId}/{variantId}/create', [Backend\ProductVariantItemController::class, 'create'])->name('product-variant-items.create');
Route::put('product-variant-items/change-status', [Backend\ProductVariantItemController::class, 'changeStatus'])->name('product-variant-items.change-status');
Route::resource('product-variant-items', Backend\ProductVariantItemController::class)->except('index', 'create');