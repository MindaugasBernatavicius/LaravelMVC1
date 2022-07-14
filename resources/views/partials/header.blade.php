<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="./">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}"
                    href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('regular.about') ? 'active' : '' }}"
                    href="{{ route('regular.about') }}">About</a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link {{ route(Route::currentRouteName()) == route('posts.index') ? 'active' : '' }}"  --}}
                <a class="nav-link {{ Request::routeIs('posts.index') ? 'active' : '' }}" 
                    href="{{ route('posts.index') }}">Posts</a>
            </li>
        </ul>
    </div>

    {{-- {{ dd(url()->getrequest()->getpathInfo()) }} --}}
    {{-- <p>{{ dump(Route::current()->getName()) }} </p> --}}
    {{-- <p>{{ dump(Request::path()) }} </p> --}}
    {{-- <p>{{ dump(request()->is('app4/about-us')) }} </p> --}}
    {{-- <p>{{ dump(Request::is('app4/about-us')) }} </p> --}}
    {{-- <p>{{ route('index') }} </p> --}}

</nav>
