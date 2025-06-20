<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::query()
            ->orderBy('name')
            ->get()
            ->toArray();

        return response()->json($products);
    }
}
