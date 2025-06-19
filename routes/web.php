<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteConfigController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SiteConfigController as AdminSiteConfigController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rotas de administração (apenas para admin)
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::patch('/admin/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.update-role');
    });
    
    // Rotas de configuração do site (para admin e gerente)
    Route::middleware('role:admin,gerente')->group(function () {
        Route::get('/admin/site-config', [SiteConfigController::class, 'index'])->name('admin.site-config.index');
        Route::post('/admin/site-config', [SiteConfigController::class, 'update'])->name('admin.site-config.update');
        Route::get('/admin/site-config/{section}', [SiteConfigController::class, 'editSection'])->name('admin.site-config.edit-section');
        Route::post('/admin/site-config/{section}', [SiteConfigController::class, 'updateSection'])->name('admin.site-config.update-section');
    });

    // Rotas de Banners
    // Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    //     Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    //     Route::get('/banners/create', [BannerController::class, 'create'])->name('banners.create');
    //     Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
    //     Route::get('/banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    //     Route::put('/banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
    //     Route::delete('/banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');
    //     Route::post('/banners/{banner}/toggle', [BannerController::class, 'toggleStatus'])->name('banners.toggle');
    // });
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rotas do Admin
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::get('/site-config', [App\Http\Controllers\SiteConfigController::class, 'index'])->name('site-config.index');
        Route::post('/site-config', [App\Http\Controllers\SiteConfigController::class, 'update'])->name('site-config.update');
    });
});

require __DIR__.'/auth.php';
