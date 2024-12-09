<x-master-layout title="Detail Post">

    @section('header')
        <h5>Detail Post</h5>
    @endsection

    <div class="row justify-content-center">
        <div class="col-10 col-md-10 col-lg-10">
            <div class="card border-0 shadow-smooth p-3">
                <div class="card-body">
                    <img src="{{ asset('/storage/posts/'.$post->thumbnail) }}" alt="Thumbnail" class="img-fluid rounded mb-3">
                    <h3>{{ $post->title }}</h3>
                    <div class="d-flex gap-4 mb-3">
                        <span>{{ \Carbon\Carbon::parse($post->created_at)->format('D, d M Y') }}</span>
                        <span>{{ $post->user->name }}</span>
                    </div>
                    <p>{!! $post->content !!}</p>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>