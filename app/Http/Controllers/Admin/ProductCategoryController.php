<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $productCategories = ProductCategory::where('name', 'LIKE', '%'.$request->search.'%')
                            ->latest()
                            ->paginate(10)
                            ->withQueryString();
        } else {
            $productCategories = ProductCategory::query()->latest()->paginate(10);
        }

        return view('admin.product-categories.index', compact('productCategories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                ProductCategory::query()->create([
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('name')),
                ]);

            });

            Alert::success('Success', 'Product Category created successfully!');
            return redirect()->route('admin.product_categories.index');

        } catch (\Throwable $th) {
            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.product_categories.index');
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

    public function update(Request $request, ProductCategory $productCategory)
    {
        try {

            DB::transaction(function () use ($request, $productCategory) {

                $productCategory->update([
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('name')),
                ]);

            });

            Alert::success('Success', 'Product Category updated successfully!');
            return redirect()->route('admin.product_categories.index');

        } catch (\Throwable $th) {

            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.product_categories.index');

        }
    }

    public function destroy(ProductCategory $productCategory)
    {
        DB::beginTransaction();
        try {

            $productCategory->delete();
            DB::commit();

            Alert::success('Success', 'Product Category deleted successfully!');
            return redirect()->route('admin.product_categories.index');

        } catch (\Throwable $th) {

            DB::rollback();

            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.product_categories.index');

        }
    }
}
