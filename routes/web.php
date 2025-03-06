<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckAdmin;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified',])->group(function () {
    Route::middleware([CheckAdmin::class,])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');
    });
    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])
            ->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])
            ->name('product.create');
        Route::get('/{product}', [ProductController::class, 'show'])
            ->name('product.show');
        Route::post('/products', [ProductController::class, 'store'])
            ->name('product.store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])
            ->name('product.edit');
        Route::delete('/{product}', [ProductController::class, 'destroy'])
            ->name('product.destroy');
        Route::patch('/edit/{product}', [ProductController::class, 'update'])
            ->name('product.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
