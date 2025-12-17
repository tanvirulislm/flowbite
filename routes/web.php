<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
})->name('dashboard');


// Category URL
Route::get('/category', [CategoryController::class, 'Categorypage'])->name('category');
Route::post('/category', [CategoryController::class, 'CreateCategory'])->name('create-category');
Route::post('/update-category/{id}', [CategoryController::class, 'UpdateCategory'])->name('update-category');
Route::delete('/delete-category/{id}', [CategoryController::class, 'DeleteCategory'])->name('delete-category');
