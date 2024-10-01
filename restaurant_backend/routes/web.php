<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/Add_product', [ProductController::class, 'show'])->name('Add_product');
    Route::post('/store_product', [ProductController::class, 'store'])->name('store_product');
    Route::get('/Show_product', [ProductController::class, 'laravelindex'])->name('Show_product');
    Route::post('/edit-product', [ProductController::class, 'edit'])->name('edit_product');
    Route::get('/products/edit/{id}', [ProductController::class, 'showEditPage'])->name('products.edit');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('update_product');
    Route::post('/products', [ProductController::class, 'destroy'])->name('delete_product');


});

require __DIR__.'/auth.php';
