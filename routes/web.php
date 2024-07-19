<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;

// This Route use guest
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

// This Route access only authenticat user
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('layouts.app');
    })->name('home');
    Route::resource('categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
