<x-master-layout title="Products">

    @section('header')
        <h5>Products</h5>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-12 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">

                    <div class="row mb-5 gap-2">
                        <div class="col-md-4">
                            <form action="{{ route('admin.products.index') }}" method="get" class="d-flex gap-2">
                                <input type="text" name="search" placeholder="Search by Name & SKU" class="form-control">
                                <button type="submit" class="btn btn-dark">Search</button>
                            </form>
                        </div>
                        <div class="col-md-2 text-start">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-dark shadow-sm" >Clear Search</a>
                        </div>
                        <div class="col-md-2 ms-auto text-end">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-dark shadow-sm" >Add Product</a>
                        </div>
                    </div>

                    @if(request()->search)
                        <div class="mb-3">
                            Result by : <span class="fw-bold">{{ request()->search }}</span>
                        </div>
                    @endif

                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>SKU</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody class="align-middle">
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->productCategory->name }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td><div class="badge bg-primary">{{ $product->status }}</div></td>
                                    <td class="text-center flex gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-dark"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-dark"><i class="bi bi-eye"></i></a>

                                        <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $product->id }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" aria-labelledby="deleteClassroomLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteClassroomLabel">Delete {{ $product->name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete it {{ $product->name }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-dark">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-dark text-center" role="alert">
                                    Data not available
                                </div>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :items="$products" />

                </div>
            </div>
        </div>
    </div>

</x-master-layout>
