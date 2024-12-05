<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductImageController extends Controller
{
    public function create(Product $product)
    {
        return view('admin.products.add-image', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate(['image' => ['required', 'mimes:jpeg,jpg,png', 'max:2048', 'mimetypes:image/jpeg,image/png']]);

        try {

            DB::transaction(function () use ($request, $product) {

                $image = $request->file('image');
                $image->storeAs('public/products', $image->hashName());

                $product->productImages()->create([
                    'image' => $image->hashName(),
                ]);

            });

            Alert::success('Success', 'Image uploaded successfully');
            return redirect()->route('admin.products.show', compact('product'));
        } catch (\Throwable $th) {
            Alert::error('Error', 'Something went wrong');
            return redirect()->route('admin.products.show', compact('product'));
        }
    }

    public function destroy(Product $product, ProductImage $productImage)
    {
        DB::beginTransaction();
        try {
            Storage::delete('/public/products/'.$productImage->image);
            $productImage->delete();
            DB::commit();
            Alert::success('Success', 'Image deleted successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong');
            return redirect()->back();
        }
    }
}
