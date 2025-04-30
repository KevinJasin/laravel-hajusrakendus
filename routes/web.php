<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\MyFavoriteSubjectController;
use App\Http\Controllers\CheckoutController;

// External Monsters API View
Route::get('/monsters', [MyFavoriteSubjectController::class, 'fetchExternalMonsters'])->name('monsters.index');

// Default landing page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/cart/add/{product}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart.index');
Route::post('/cart/update', [ShopController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('cart.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'checkoutForm'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'createCheckoutSession'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

// Favorite Subjects
Route::get('/subjects/create', [MyFavoriteSubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects', [MyFavoriteSubjectController::class, 'store'])->name('subjects.store');
Route::get('/subjects', [MyFavoriteSubjectController::class, 'list'])->name('subjects.list');
Route::delete('/subjects/{subject}', [MyFavoriteSubjectController::class, 'destroy'])->name('subjects.destroy');

// Weather
Route::get('/weather', [WeatherController::class, 'show'])->name('weather');

// Map & Markers
Route::get('/map', [MarkerController::class, 'map'])->name('map');
Route::post('/markers', [MarkerController::class, 'store'])->name('markers.store');
Route::get('/markers', [MarkerController::class, 'list'])->name('markers.list');
Route::get('/markers/{marker}/edit', [MarkerController::class, 'edit'])->name('markers.edit');
Route::put('/markers/{marker}', [MarkerController::class, 'update'])->name('markers.update');
Route::delete('/markers/{marker}', [MarkerController::class, 'destroy'])->name('markers.destroy');

// Auth routes
Route::middleware(['auth'])->group(function () {
    Route::resource('blogs', BlogController::class);
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
