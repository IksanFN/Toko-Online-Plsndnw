<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Prodcuts\ProductStore;
use App\Http\Requests\Admin\Prodcuts\ProductUpdate;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::search($request->input('search'))->with('productCategory')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.products.create', compact('productCategories'));
    }

    public function store(ProductStore $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $thumbnail = $request->file('thumbnail');
                $thumbnail->storeAs('/public/products', $thumbnail->hashName());

                $product = Product::query()->create([
                    'product_category_id' => $request->input('product_category_id'),
                    'thumbnail' => $thumbnail->hashName(),
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('name')),
                    'sku' => Product::generateSKU($request->input('product_category_id')),
                    'price' => $request->input('price'),
                    'description' => $request->input('description'),
                ]);
            });

            Alert::success('Success', 'Product created successfully!');
            return redirect()->route('admin.products.index');

        } catch (\Throwable $th) {

            Alert::error('Error', $th->getMessage());
            return redirect()->route('admin.products.index');

        }
    }

    public function show(Product $product)
    {
//        $productImages = ProductImage::query()->where('product_id', $product->id)->get();
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $productCategories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'productCategories'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            DB::transaction(function () use ($request, $product) {

                $updateData = [
                    'product_category_id' => $request->input('product_category_id'),
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('name')),
                    'price' => $request->input('price'),
                    'description' => $request->input('description'),
                ];

                // Handle thumbnail upload and update
                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $request->file('thumbnail');
                    $thumbnail->storeAs('public/products', $thumbnail->hashName());
                    Storage::delete('public/products/' . $product->thumbnail);
                    $updateData['thumbnail'] = $thumbnail->hashName();
                }

                // Update SKU only if category changes
                if ($request->input('product_category_id') != $product->product_category_id) {
                    $updateData['sku'] = Product::updateSKU($request->input('product_category_id'));
                }

                $product->update($updateData);

            });

            Alert::success('Success', 'Product updated successfully!');
            return redirect()->route('admin.products.index');

        } catch (\Throwable $th) {

            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.products.index');

        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
            Alert::success('Success', 'Product deleted successfully!');
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.products.index');
        }
    }

}
