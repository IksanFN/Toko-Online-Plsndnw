<x-master-layout title="Edit Post">

    @section('header')
        <h5>Edit Post</h5>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth">
                <div class="card-body">
                    <form action="{{ route('admin.posts.update', $post->slug) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Category</label>
                            <select class="form-select" name="post_category_id">
                                <option value="default" hidden>Pilih Category</option>
                                @foreach($postCategories as $category)
                                    <option value="{{ $category->id }}" {{ $post->post_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('post_category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control">
                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="default" hidden>Pilih Status</option>
                                @foreach($postStatuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $post->status) == $status ? 'selected' : '' }}>{{ $status->value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea id="mytextarea" name="content" class="form-control">
                                {!! $post->content !!}
                            </textarea>
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-dark px-4 shadow-sm">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>