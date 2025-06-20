<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:sanctum'])->name('dashboard');

Route::group(['middleware' => ['auth:sanctum'], 'as' => 'products.', 'prefix' => '/products'], function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::group(['middleware' => ['auth:sanctum'], 'as' => 'salesOrders.', 'prefix' => '/salesOrders'], function () {
    Route::get('', [SalesOrderController::class, 'index'])->name('index');
    Route::get('/create', [SalesOrderController::class, 'create'])->name('create');
    Route::post('', [SalesOrderController::class, 'store'])->name('store');
    Route::get('/{salesOrder}', [SalesOrderController::class, 'show'])->name('show');
    Route::get('/{salesOrder}/edit', [SalesOrderController::class, 'edit'])->name('edit');
    Route::put('/{salesOrder}', [SalesOrderController::class, 'update'])->name('update');
    Route::delete('/{salesOrder}', [SalesOrderController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
