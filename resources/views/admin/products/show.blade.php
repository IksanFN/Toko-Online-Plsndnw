<x-master-layout title="Product Detail">

    @section('header')
        <h5>Product Detail</h5>
    @endsection

    <section class="row">
        <div class="col-lg-4">
            <div class="card border-0 shadow-smooth mb-3">
                <div class="card-header">
                    Thumbnail
                </div>
                <div class="card-body">
                    <img src="{{ asset('/storage/products/'.$product->thumbnail) }}" alt="Thumbnail" class="img-fluid rounded">
                </div>
            </div>

            <div class="card border-0 shadow-smooth mb-3">
                <div class="card-header">
                    Gallery Product
                </div>
                <div class="card-body">

                    <div class="mb-2 text-end">
                        <a href="{{ route('admin.products.add_image', $product->id) }}" class="btn btn-dark fw-bold"><i class="bi bi-plus-lg"></i></a>
                    </div>

                    <div id="carouselExampleAutoplaying" class="carousel slide mb-3" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($product->productImages as $index => $item)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('/storage/products/'.$item->image) }}" class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <ul class="list-group">
                        @forelse($product->productImages as $index => $item)
                            <li class="list-group-item">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Image ke {{ $loop->iteration }}</span>
                                    <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" aria-labelledby="deleteClassroomLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteClassroomLabel">Delete Image {{ $loop->iteration }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete it Image ke {{ $loop->iteration }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.products.delete_image', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <div class="alert alert-dark text-center" role="alert">
                                Image not available
                            </div>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="card border-0 shadow-smooth p-3">
                <div class="card-body">
                    <h3>{{ $product->name }}</h3>
                    <hr/>
                    <p><strong>SKU : </strong>{{ $product->sku }}</p>
                    <p><strong>Category : </strong>{{ $product->productCategory->name }}</p>
                    <p><strong>Price : </strong>{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                    <div class="mt-4">
                        <h5>Description : </h5>
                        <hr>
                        <p>{!! $product->description !!}</p>
                    </div>
                </div>
            </div>


        </div>
    </section>

</x-master-layout>
