<x-master-layout title="Update Product Stock">

    @section('header')
        <h5>Update Product Stock</h5>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth">
                <div class="card-body">
                    <form action="{{ route('admin.product_stocks.update', $productStock->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Product</label>
                            <select class="form-select" name="product_id">
                                <option value="default" hidden>Pilih Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($product->id = $productStock->product_id) ? 'selected' : ''}}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="quantity" value="{{ $productStock->quantity }}">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Size</label>
                            <select class="form-select" name="size">
                                <option value="default" hidden>Pilih Size</option>
                                @foreach(App\Enums\SizeType::cases() as $size)
                                    <option value="{{ $size->value }}" {{ $size->value == $productStock->size ? 'selected' : '' }}>{{ $size->value }}</option>
                                @endforeach
                            </select>
                            @error('size')
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