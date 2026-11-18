<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});