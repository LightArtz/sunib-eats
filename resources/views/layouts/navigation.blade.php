<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" alt="Sunib Eats Logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <form class="d-flex me-auto my-2 my-lg-0" action="{{ route('home') }}" method="GET">
                <input class="form-control form-control-sm me-2"
                    type="search"
                    name="search"
                    placeholder="Cari resto / lokasi..."
                    value="{{ request('search') }}">

                @if(request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                <button class="btn btn-sm btn-outline-light" type="submit">Cari</button>
            </form>

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item me-2">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link {{ request()->routeIs('explore') ? 'active' : '' }}" href="{{ route('explore') }}">Jelajahi</a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item me-2 fw-bold">
                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary btn-sm px-3 fw-bold rounded" href="{{ route('register') }}">Daftar</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>