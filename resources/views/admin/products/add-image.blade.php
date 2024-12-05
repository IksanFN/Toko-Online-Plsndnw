<x-master-layout title="Add Product Image">

    @section('header')
        <h5>Add Product Image</h5>
    @endsection

    <section class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card border-0 shadow-smooth p-3">
                <div class="card-body">
                    <form action="{{ route('admin.products.store_image', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-master-layout>
