<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('home'); // trang login
});

/**
 * ADMIN LOGIN
 */
Route::post('/admin/login', [AdminAuthController::class, 'login'])->middleware('web');

/**
 * ADMIN AREA
 */
Route::middleware(['web', 'admin'])->group(function () {

    Route::get('/admin', [DashboardController::class, 'index']);

    Route::post('/admin/logout', [AdminAuthController::class, 'logout']);
});
