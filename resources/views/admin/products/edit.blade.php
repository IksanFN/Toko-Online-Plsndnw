<x-master-layout title="Edit Product">

    @section('header')
        <h5>Edit Product</h5>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Category</label>
                            <select class="form-select" name="product_category_id">
                                <option value="default" hidden>Pilih Category</option>
                                @foreach($productCategories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->product_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('product_category_id')
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
                            <label for="title" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="mytextarea" name="description" class="form-control">
                                {!! $product->description !!}
                            </textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-dark px-4 shadow-sm">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>