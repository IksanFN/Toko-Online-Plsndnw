<x-master-layout title="Create Category">

    @section('header')
        <h5>Create Post Categories</h5>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth">
                <div class="card-body">
                    <form action="{{ route('admin.posts.categories.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug">
                            @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
