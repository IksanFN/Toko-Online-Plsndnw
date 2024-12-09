<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SizeType;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductStockController extends Controller
{
    public function index(Request $request)
    {
        $productStocks = ProductStock::search($request->input('search'))->with('product')->latest()->paginate(10);

        return view('admin.product-stocks.index', compact('productStocks'));
    }

    public function create()
    {
        $sizeTypes = SizeType::getLabels();
        $products = Product::query()->select('id', 'name')->get();
        return view('admin.product-stocks.create', compact('products', 'sizeTypes'));
    }

    public function store(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $productStock = ProductStock::query()->create([
                    'product_id' => $request->input('product_id'),
                    'quantity' => $request->input('quantity'),
                    'size' => $request->input('size'),
                ]);

            });

            Alert::suceess('Success', 'Product Stock has been created');
            return redirect()->route('admin.product_stocks.index');

        } catch (\Throwable $th) {

            Alert::error('Error', 'Error creating product stock');
            return redirect()->route('admin.product_stocks.index');

        }
    }

    public function edit(ProductStock $productStock)
    {
        return view('admin.product-stocks.edit', compact('productStock'));
    }

    public function update(Request $request, ProductStock $productStock)
    {
        try {
            DB::transaction(function () use ($request, $productStock) {
                $productStock->update([
                    'product_id' => $request->input('product_id'),
                    'quantity' => $request->input('quantity'),
                    'size' => $request->input('size'),
                ]);
            });

            Alert::success('Success', 'Product Stock has been updated');
            return redirect()->route('admin.product_stocks.index');

        } catch (\Throwable $th) {
            Alert::error('Error', 'Error updating product stock');
            return redirect()->route('admin.product_stocks.index');
        }
    }


}
