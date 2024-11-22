<x-auth-layout title="Login">

    @section('header')
        <h3 class="text-center mt-5">Welcome Back to <span class="text-dark fw-bold">PLSNDNW.</span></h3>
    @endsection

    <div class="row justify-content-center mt-4">
        <div class="col-md-6 col-lg-6">
            <div class="card border-0 shadow-smooth p-3">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email..">
                            @error('email')
                            <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password...">
                            @error('password')
                            <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-dark px-5 shadow-smooth">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 row justify-content-center">
        <div class="col-md-6 col-md-6 text-center">
            <span>Created by <a href="https://github.com/IksanFN" target="_blank">IksanFN</a></span>
        </div>
    </div>

</x-auth-layout>
