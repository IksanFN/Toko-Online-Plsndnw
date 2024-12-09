<?php

use App\Http\Controllers\Admin\ImageProductController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->name('admin.')->group(function () {

        // Route Product Category
        Route::prefix('products-categories')->name('products.categories.')->group(function () {
            Route::controller(ProductCategoryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{productCategory}', 'edit')->name('edit');
                Route::put('/update/{productCategory}', 'update')->name('update');
                Route::delete('/destroy/{productCategory}', 'destroy')->name('destroy');
            });
        });

        // Route Posts Category
        Route::prefix('posts-categories')->name('posts.categories.')->group(function () {
            Route::controller(PostCategoryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{postCategory}', 'edit')->name('edit');
                Route::put('/update/{postCategory}', 'update')->name('update');
                Route::delete('/destroy/{postCategory}', 'destroy')->name('destroy');
            });
        });

        // Route Sliders
        Route::prefix('sliders')->name('sliders.')->group(function () {
            Route::controller(SliderController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{slider}', 'edit')->name('edit');
                Route::put('/update/{slider}', 'update')->name('update');
                Route::delete('/destroy/{slider}', 'destroy')->name('destroy');
            });
        });

        // Route Posts
        Route::prefix('posts')->name('posts.')->group(function () {
            Route::controller(PostController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{post}', 'show')->name('show');
                Route::post('/store', 'store')->name('store');
                Route::get('/{post}/edit', 'edit')->name('edit');
                Route::put('/update/{post}', 'update')->name('update');
                Route::delete('/destroy/{post}', 'destroy')->name('destroy');
            });
        });

        // Route Products
        Route::prefix('products')->name('products.')->group(function () {

            // Product
            Route::controller(ProductController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{product}', 'show')->name('show');
                Route::post('/store', 'store')->name('store');
                Route::get('/{product}/edit', 'edit')->name('edit');
                Route::put('/update/{product}', 'update')->name('update');
                Route::delete('/destroy/{product}', 'destroy')->name('destroy');
            });

            // Product Image
            Route::controller(ProductImageController::class)->group(function () {
                Route::get('/add-image/{product}', 'create')->name('add_image');
                Route::post('/add-image/{product}', 'store')->name('store_image');
                Route::delete('/{productImage}', 'destroy')->name('delete_image');
            });

        });

    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
