<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\AttributeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
})->name('dashboard');


// Category URL
Route::get('/category', [CategoryController::class, 'Categorypage'])->name('category');
Route::post('/category', [CategoryController::class, 'CreateCategory'])->name('create-category');
Route::post('/update-category/{id}', [CategoryController::class, 'UpdateCategory'])->name('update-category');
Route::delete('/delete-category/{id}', [CategoryController::class, 'DeleteCategory'])->name('delete-category');


// Brand URL
Route::get('/brand', [BrandController::class, 'BrandPage'])->name('brand');
Route::post('/brand', [BrandController::class, 'CreateBrand'])->name('create-brand');
Route::post('/update-brand/{id}', [BrandController::class, 'UpdateBrand'])->name('update-brand');
Route::delete('/delete-brand/{id}', [BrandController::class, 'DeleteBrand'])->name('delete-brand');


// Customer And Supplier URL
Route::get('/customer', [PartyController::class, 'CustomerPage'])->name('customer');
Route::get('/supplier', [PartyController::class, 'SupplierPage'])->name('supplier');
Route::post('/party', [PartyController::class, 'CreateParty'])->name('create-party');
Route::post('/update-party/{id}', [PartyController::class, 'UpdateParty'])->name('update-party');
Route::delete('/delete-party/{id}', [PartyController::class, 'DeleteParty'])->name('delete-party');


// Product URL
Route::get('/product', [ProductController::class, 'ProductPage'])->name('product');
Route::get('/create-product', [ProductController::class, 'CreateProductPage'])->name('create-product');
Route::post('/create-product', [ProductController::class, 'CreateProduct'])->name('create-product-post');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('delete-product');

// Product Variation
Route::get('/variation', [VariationController::class, 'VariationPage'])->name('variation');
Route::post('/variation', [VariationController::class, 'CreateVariation'])->name('create-variation');
Route::post('/update-variation/{id}', [VariationController::class, 'UpdateVariation'])->name('update-variation');
Route::delete('/delete-variation/{id}', [VariationController::class, 'DeleteVariation'])->name('delete-variation');

// Product Attribute Optional
Route::get('/attribute', [AttributeController::class, 'AttributePage'])->name('attribute');
Route::post('/attribute', [AttributeController::class, 'CreateAttribute'])->name('create-attribute');
Route::post('/update-attribute/{id}', [AttributeController::class, 'UpdateAttribute'])->name('update-attribute');
Route::delete('/delete-attribute/{id}', [AttributeController::class, 'DeleteAttribute'])->name('delete-attribute');
