<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SizeType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStock\ProductStockStore;
use App\Http\Requests\Admin\ProductStock\ProductStockUpdate;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductStockController extends Controller
{
    public function index(Request $request)
    {
        $productStocks = ProductStock::search($request->input('search'))->latest()->paginate(10);
        $productStocks->appends($request->only('search'));

        return view('admin.product-stocks.index', compact('productStocks'));
    }

    public function create()
    {
        $sizeTypes = SizeType::getLabels();
        $products = Product::query()->select('id', 'name')->get();
        return view('admin.product-stocks.create', compact('products', 'sizeTypes'));
    }

    public function store(ProductStockStore $request)
    {

        $productSizeCount = ProductStock::query()
            ->where('size', $request->size)
            ->where('product_id', $request->product_id)
            ->count();

        $product = Product::query()->find($request->input('product_id'));

        if ($productSizeCount > 0) {
            Alert::error('Error', "$product->name products already have size $request->size");
            return back()->withInput();
        }

        try {

            DB::transaction(function () use ($request) {

                $productStock = ProductStock::query()->create([
                    'product_id' => $request->input('product_id'),
                    'quantity' => $request->input('quantity'),
                    'size' => $request->input('size'),
                ]);

            });

            Alert::success('Success', 'Product Stock has been created');
            return redirect()->route('admin.product_stocks.index');

        } catch (\Throwable $th) {

            Alert::error('Error', $th->getMessage());
            return redirect()->route('admin.product_stocks.index');

        }

    }

    public function edit(ProductStock $productStock)
    {
        $sizeTypes = SizeType::getLabels();
        $products = Product::query()->select('id', 'name')->get();
        return view('admin.product-stocks.edit', compact('productStock', 'products', 'sizeTypes'));
    }

    public function update(ProductStockUpdate $request, ProductStock $productStock)
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

    public function destroy(ProductStock $productStock)
    {
        DB::beginTransaction();
        try {
            $productStock->delete();
            DB::commit();
            Alert::success('Success', 'Product Stock has been deleted');
            return redirect()->route('admin.product_stocks.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Error', 'Error deleting product stock');
            return redirect()->route('admin.product_stocks.index');
        }
    }
}
