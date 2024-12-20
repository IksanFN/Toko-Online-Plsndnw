<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategory\ProductCategoryStore;
use App\Http\Requests\Admin\ProductCategory\ProductCategoryUpdate;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $productCategories = ProductCategory::search($request->search)->latest()->paginate(10);
        return view('admin.product-categories.index', compact('productCategories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(ProductCategoryStore $request)
    {
        try {
            DB::transaction(function () use ($request) {

                ProductCategory::query()->create([
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('name')),
                    'code' => $request->input('code'),
                ]);

            });

            Alert::success('Success', 'Product Category created successfully!');
            return redirect()->route('admin.products.categories.index');

        } catch (\Throwable $th) {
            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.products.categories.index');
        }
    }

    public function show(ProductCategory $productCategory)
    {
        //
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    public function update(ProductCategoryUpdate $request, ProductCategory $productCategory)
    {
        try {

            DB::transaction(function () use ($request, $productCategory) {

                $productCategory->update([
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('name')),
                    'code' => $request->input('code'),
                ]);

            });

            Alert::success('Success', 'Product Category updated successfully!');
            return redirect()->route('admin.products.categories.index');

        } catch (\Throwable $th) {

            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.products.categories.index');

        }
    }

    public function destroy(ProductCategory $productCategory)
    {
        DB::beginTransaction();
        try {

            $productCategory->delete();
            DB::commit();

            Alert::success('Success', 'Product Category deleted successfully!');
            return redirect()->route('admin.products.categories.index');

        } catch (\Throwable $th) {

            DB::rollback();

            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.products.categories.index');

        }
    }
}
