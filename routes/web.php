<?php

use App\Http\Controllers\Backend;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [Frontend\HomeController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/** Admin Routes */
Route::get('/admin/login', [Backend\AdminController::class, 'login'])->name('admin.login');
/** Vendor Routes */
Route::get('/vendor/login', [Backend\VendorController::class, 'login'])->name('vendor.login');

Route::get('flash-sale', [Frontend\FlashSaleController::class, 'index'])->name('flash-sale');


Route::middleware(['auth', 'verified'])->prefix('user')->as('user.')->group(function () {
    Route::get('/dashboard', [Frontend\UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [Frontend\UserProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [Frontend\UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile', [Frontend\UserProfileController::class, 'updatePassword'])->name('profile.update.password');
});
