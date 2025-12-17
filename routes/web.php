<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
});


// Category URL
Route::get('/category', [CategoryController::class, 'Categorypage'])->name('category');
Route::post('/category', [CategoryController::class, 'CreateCategory'])->name('create-category');

