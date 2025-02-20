<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminKeycapController;   // Corrected controller names
use App\Http\Controllers\AdminKeyboardController;
use App\Http\Controllers\AdminSwitchController;

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

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// User Dashboard Routes
Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// Admin Routes - Protected by 'adminMiddleware'
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // **Admin Resource Routes - Corrected and Separated for Product Types**

    // General Admin Product Routes (Index - showing all products, Show, Edit, Update, Destroy)
    Route::resource('admin/products', ProductController::class)->names('admin.products')->except(['create', 'store']); // General product management (excluding create/store)

    // Admin Routes for Keycaps (Specific index, create, store - reusing show, edit, update, destroy from ProductController)
    Route::resource('admin/keycaps', AdminKeycapController::class)->names('admin.keycaps')->except(['show', 'edit', 'update', 'destroy']); // Keycap specific management

    // Admin Routes for Keyboards (Specific index, create, store - reusing show, edit, update, destroy from ProductController)
    Route::resource('admin/keyboards', AdminKeyboardController::class)->names('admin.keyboards')->except(['show', 'edit', 'update', 'destroy']); // Keyboard specific management

    // Admin Routes for Switches (Specific index, create, store - reusing show, edit, update, destroy from ProductController)
    Route::resource('admin/keyboard-switches', AdminSwitchController::class)->names('admin.keyboard-switches')->except(['show', 'edit', 'update', 'destroy']); // Switch specific management


    // Admin Resource Routes for Orders (Orders are managed by OrderController)
    Route::resource('admin/orders', OrderController::class)->names('admin.orders'); // Order management
});