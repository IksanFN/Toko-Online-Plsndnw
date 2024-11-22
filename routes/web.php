<?php

use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\ProductCategoryController;
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

    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
