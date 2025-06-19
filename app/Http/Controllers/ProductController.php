<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable, Request $request)
    {
        if ($request->ajax()) {

            $data = Product::query();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($row) {
                        return view('products.actions', compact('row'));
                    })
                    ->editColumn('stock', function ($row) {
                        return intval($row->stock);
                    })
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->diffForHumans();
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
        }
        return $dataTable->render('products.index');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku,' . $product->id],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
