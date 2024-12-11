<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\PostStore;
use App\Http\Requests\Admin\Post\PostUpdate;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PostCategoryController extends Controller
{
    public function index(Request $request)
    {
        $postCategories = PostCategory::query()->search($request->search)->latest()->paginate(10);

        return view('admin.post-categories.index', compact('postCategories'));
    }

    public function create()
    {
        return view('admin.post-categories.create');
    }

    public function store(PostStore $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $postCategory = PostCategory::query()->create([
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('slug')),
                ]);

            });

            Alert::success('Success', 'Post Category Created Successfully');
            return redirect()->route('admin.posts.categories.index');

        } catch (\Throwable $th) {

            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.posts.categories.index');

        }
    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.post-categories.edit', compact('postCategory'));
    }

    public function update(PostUpdate $request, PostCategory $postCategory)
    {
        try {
            DB::transaction(function () use ($request, $postCategory) {
                $postCategory->update([
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('slug')),
                ]);
            });

            Alert::success('Success', 'Post Category Updated Successfully');
            return redirect()->route('admin.posts.categories.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.posts.categories.index');
        }
    }

    public function destroy(PostCategory $postCategory)
    {
        DB::beginTransaction();
        try {
            $postCategory->delete();
            DB::commit();
            Alert::success('Success', 'Post Category Deleted Successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.posts.categories.index');
        }
    }
}
