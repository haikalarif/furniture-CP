<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/proses', [HomeController::class, 'process'])->name('process');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [HomeController::class, 'contactStore'])->name('contact.store');

Route::prefix('produk')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// Route::prefix('artikel')->name('articles.')->group(function () {
//     Route::get('/', [ArticleController::class, 'index'])->name('index');
//     Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
// });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('products', AdminProductController::class)->except(['show']);
    Route::resource('articles', AdminArticleController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('features', FeatureController::class)->except(['show']);
    Route::resource('galleries', AdminGalleryController::class)->except(['show']);
    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('pages', PageController::class)->only(['index', 'edit', 'update']);
});

/*
|--------------------------------------------------------------------------
| Profile Routes (from Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
