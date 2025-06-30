<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

// 🔐 Giriş yapmış kullanıcıların erişebileceği grup (Jetstream + Sanctum + Verified)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // 📌 Kullanıcı Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 📄 Post İşlemleri
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::resource('posts', PostController::class)->except(['index']);

    // 📁 Kategori İşlemleri
    Route::resource('categories', CategoryController::class);
});

// 🔐 Admin paneline sadece admin rolü ile giriş yapılabilir
Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
