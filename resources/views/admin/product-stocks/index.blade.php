<x-master-layout title="Product Stocks">

    @section('header')
        <h5>Product Stocks</h5>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-12 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">

                    <div class="row mb-5 gap-2">
                        <div class="col-md-4">
                            <form action="{{ route('admin.product_stocks.index') }}" method="get" class="d-flex gap-2">
                                <input type="text" name="search" placeholder="Search" class="form-control">
                                <button type="submit" class="btn btn-dark">Search</button>
                            </form>
                        </div>
                        <div class="col-md-2 text-start">
                            <a href="{{ route('admin.product_stocks.index') }}" class="btn btn-dark shadow-sm" >Clear Search</a>
                        </div>
                        <div class="col-md-2 ms-auto text-end">
                            <a href="{{ route('admin.product_stocks.create') }}" class="btn btn-dark shadow-sm" >Add Stock</a>
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
                            <th>No</th>
                            <th>Product</th>
                            <th>Stock</th>
                            <th>Size</th>
                            <th class="text-center">Action</th>
                            </thead>
                            <tbody class="align-middle">
                            @forelse ($productStocks as $stock)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $stock->product->name }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->size }}</td>
                                    <td class="text-center flex gap-2">
                                        <a href="{{ route('admin.product_stocks.edit', $stock->id) }}" class="btn btn-dark"><i class="bi bi-pencil-square"></i></a>

                                        <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $stock->id }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete{{ $stock->id }}" tabindex="-1" aria-labelledby="deleteClassroomLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteClassroomLabel">Delete {{ $stock->title }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete it {{ $stock->title }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.product_stocks.destroy', $stock->id) }}" method="post">
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
                    <x-pagination :items="$productStocks" />

                </div>
            </div>
        </div>
    </div>

</x-master-layout>
