<?php

namespace App\Http\Controllers\Admin;

use id;
use App\Models\Post;
use App\Models\Category;
use App\Enums\PostStatus;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search($request->search)->with('postCategory')->latest()->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $postCategories = PostCategory::all();
        $postStatuses = PostStatus::getLabels();
        return view('admin.posts.create', compact('postCategories', 'postStatuses'));
    }

    public function store(Request $request)
    {
        $thumbnail = $request->file('thumbnail');
        $thumbnail->storeAs('public/posts', $thumbnail->hashName());
        try {
            DB::transaction(function () use ($request, $thumbnail) {

                $published = null;
                if ($request->input('status') == PostStatus::PUBLISHED) {
                    $published = $request->input('status');
                }

                $post = Post::query()->create([
                    'user_id' => Auth::user()->id,
                    'post_category_id' => $request->input('post_category_id'),
                    'thumbnail' => $thumbnail->hashName(),
                    'title' => $request->input('title'),
                    'slug' => Str::slug($request->input('title')),
                    'content' => $request->input('content'),
                    'status' => $request->input('status') ,
                    'published_at' => $published,
                ]);

            });

            Alert::success('Success', 'Posts Created Successfully');
            return redirect()->route('admin.posts.index');

        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->route('admin.posts.index');
        }
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $postCategories = PostCategory::all();
        $postStatuses = PostStatus::getLabels();

        return view('admin.posts.edit', compact('post', 'postCategories', 'postStatuses'));
    }

    public function update(Request $request, Post $post)
    {
        try {
            DB::transaction(function () use ($request, $post) {

                $published = null;
                if ($request->input('status') == PostStatus::PUBLISHED) {
                    $published = $request->input('status');
                }

                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $request->file('thumbnail');
                    $thumbnail->storeAs('public/posts', $thumbnail->hashName());

                    Storage::delete('public/posts/'.$post->thumbnail);

                    $post->update([
                        'post_category_id' => $request->input('post_category_id'),
                        'thumbnail' => $thumbnail->hashName(),
                        'title' => $request->input('title'),
                        'slug' => Str::slug($request->input('title')),
                        'content' => $request->input('content'),
                        'status' => $request->input('status'),
                        'published_at' => $published,
                    ]);
                } else {
                    $post->update([
                        'post_category_id' => $request->input('post_category_id'),
                        'title' => $request->input('title'),
                        'slug' => Str::slug($request->input('title')),
                        'content' => $request->input('content'),
                        'status' => $request->input('status'),
                        'published_at' => $published,
                    ]);
                }

            });

            Alert::success('Success', 'Post Updated Successfully');
            return redirect()->route('admin.posts.index');

        } catch (\Throwable $th) {
            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.posts.index');
        }
    }

    public function destroy(Post $post)
    {
        DB::beginTransaction();
        try {
            $post->delete();
            DB::commit();
            Alert::success('Success', 'Post Deleted Successfully');
            return redirect()->route('admin.posts.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Error', 'Something went wrong!');
            return redirect()->route('admin.posts.index');
        }
    }
}
