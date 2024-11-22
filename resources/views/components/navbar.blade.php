<nav class="navbar navbar-expand-lg py-3 bg-white sticky-top shadow-smooth">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">PLSNDNW.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <x-navbar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-navbar-link>
                </li>

                {{-- Transaction --}}
                 <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Master Data
                  </a>
                  <ul class="dropdown-menu border-0 shadow-smooth p-3">
                    <li><a wire:navigate class="dropdown-item" href="{{ route('admin.products.categories.index') }}">Product Categories</a></li>
                    <li><a wire:navigate class="dropdown-item" href="{{ route('admin.posts.categories.index') }}">Post Categories</a></li>
                    <li><a wire:navigate class="dropdown-item" href="{{ route('admin.sliders.index') }}">Sliders</a></li>
                  </ul>
                </li>
            </ul>
            {{-- @auth --}}
            <div class="flex-shrink-0 dropdown">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                    <img src="{{ asset('storage/avatar/'.Auth::user()->avatar) }}" width="40" height="40" class="ms-2 rounded-circle">
                </a>
                <ul class="dropdown-menu text-small shadow-smooth border-0">
                    <li><a wire:navigate class="dropdown-item" href="{{ route('dashboard') }}">My Dashboard</a></li>
                    <li><a wire:navigate class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            {{-- @endauth --}}
        </div>
    </div>
</nav>
