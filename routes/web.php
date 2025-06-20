<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use App\Livewire\SalesOrder;
use App\Models\Product;
use App\Models\SalesOrder as SalesOrderModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $is_admin = auth()->user()->role == 'admin';
    $total_sales_count = $is_admin ? SalesOrderModel::query()->where('status', 'completed')->count() : SalesOrderModel::query()->where('status', 'completed')->where('created_by', auth()->user()->id)->count();
    $total_sales_amount = $is_admin ? SalesOrderModel::query()->where('status', 'completed')->get()->sum('total_amount') : SalesOrderModel::query()->where('status', 'completed')->where('created_by', auth()->user()->id)->get()->sum('total_amount');
    $total_products_count = Product::query()->count();
    $total_product_stock = Product::query()->sum('stock');
    return view('dashboard', [
        'total_sales_count' => $total_sales_count,
        'total_sales_amount' => $total_sales_amount,
        'total_products_count' => $total_products_count,
        'total_product_stock' => $total_product_stock,
    ]);
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
