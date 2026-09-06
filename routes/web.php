<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CatalogController as AdminCatalogController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;

/*
|--------------------------------------------------------------------------
| Cookies Intan - Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama (Landing Page)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');

// Admin Guest Routes (Login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Admin Protected Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', fn() => redirect()->route('admin.catalog.index'))->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Manajemen Katalog Produk
        Route::prefix('catalog')->name('catalog.')->group(function () {
            Route::get('/', [AdminCatalogController::class, 'index'])->name('index');
            Route::get('/create', [AdminCatalogController::class, 'create'])->name('create');
            Route::post('/', [AdminCatalogController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [AdminCatalogController::class, 'edit'])->name('edit');
            Route::put('/{product}', [AdminCatalogController::class, 'update'])->name('update');
            Route::delete('/{product}', [AdminCatalogController::class, 'destroy'])->name('destroy');
            Route::patch('/{product}/toggle', [AdminCatalogController::class, 'toggleStatus'])->name('toggle');
        });

        // Pengaturan Teks Halaman Depan
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [AdminSettingController::class, 'index'])->name('index');
            Route::post('/', [AdminSettingController::class, 'update'])->name('update');
            Route::post('/reset', [AdminSettingController::class, 'reset'])->name('reset');
        });
    });
});

// Melayani file uploads statis dari public/uploads atau /tmp/uploads (untuk Vercel Serverless)
Route::get('/uploads/{path}', function ($path) {
    $fileInPublic = public_path('uploads/' . $path);
    if (file_exists($fileInPublic) && is_file($fileInPublic)) {
        return response()->file($fileInPublic);
    }

    $fileInTmp = '/tmp/uploads/' . $path;
    if (file_exists($fileInTmp) && is_file($fileInTmp)) {
        return response()->file($fileInTmp);
    }

    abort(404);
})->where('path', '.*')->name('uploads.serve');

