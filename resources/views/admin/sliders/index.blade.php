<x-master-layout title="Sliders">

    @section('header')
        <h5>Sliders</h5>
    @endsection

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-12 col-sm-12">
                <div class="card border-0 shadow-smooth p-2">
                    <div class="card-body">

                        <div class="row mb-5 gap-2">
                            <div class="col-md-4">
                                <form action="{{ route('admin.sliders.index') }}" method="get" class="d-flex gap-2">
                                    <input type="text" name="search" placeholder="Search" class="form-control">
                                    <button type="submit" class="btn btn-dark">Search</button>
                                </form>
                            </div>
                            <div class="col-md-2 text-start">
                                <a href="{{ route('admin.sliders.index') }}" class="btn btn-dark shadow-sm" >Clear Search</a>
                            </div>
                            <div class="col-md-2 ms-auto text-end">
                                <a href="{{ route('admin.sliders.create') }}" class="btn btn-dark shadow-sm" >Add Slider</a>
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
                                <th>Thumbnail</th>
                                <th>Tagline</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th class="text-center">Action</th>
                                </thead>
                                <tbody class="align-middle">
                                @forelse ($sliders as $slider)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <img src="{{ asset('/storage/thumbnails/'.$slider->thumbnail) }}" alt="" class="img-fluid rounded" width="300px">
                                        </td>
                                        <td>{{ $slider->tagline }}</td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->content }}</td>
                                        <td class="text-center flex gap-2">
                                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-dark"><i class="bi bi-pencil-square"></i></a>
                                            <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#view{{ $slider->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                            <!-- Modal View -->
                                            <div class="modal fade" id="view{{ $slider->id }}" tabindex="-1" aria-labelledby="viewData" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="viewData">Detail {{ $slider->title }}</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <img src="{{ asset('/storage/thumbnails/'.$slider->thumbnail) }}" alt="" class="img-fluid rounded" width="70%">
                                                            </div>
                                                            <ul class="list-group text-start">
                                                                <li class="list-group-item"><span class="fw-bold">Title : </span>{{ $slider->title }}</li>
                                                                <li class="list-group-item"><span class="fw-bold">Tagline : </span>{{ $slider->tagline }}</li>
                                                                <li class="list-group-item"><span class="fw-bold">Content : </span>{{ $slider->content }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-dark">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $slider->id }}">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete{{ $slider->id }}" tabindex="-1" aria-labelledby="deleteClassroomLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="deleteClassroomLabel">Delete {{ $slider->title }}</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete it {{ $slider->title }}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="post">
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
                        <x-pagination :items="$sliders" />

                    </div>
                </div>
            </div>
        </div>

</x-master-layout>
