<nav class="navbar bg-dark text-light py-2">
    <div class="container">

        <div class="logo">
            <strong class="fs-4">
                <a class="text-light" href="{{ route('post.index') }}">IXU<span class="text-warning">SII</span></a>
            </strong>
        </div>
        {{-- ---------- --}}
        <ul class="list-unstyled d-flex m-0">
            @auth
                <li><a class="d-block py-4 px-3 text-light" href="{{ route('post.index') }}">Home</a></li>
                <li><a class="d-block py-4 px-3 text-light" href="{{ route('user.show', auth()->user()->id) }}">Profile</a></li>
                <li><a class="d-block py-4 px-3 text-light" href="{{ route('user.edit', auth()->user()->id) }}">Settings</a></li>
                <li><a class="d-block py-4 px-3 text-light" href="{{ route('user.logout') }}">Logout</a></li>
            @endauth
            @guest
                <li><a class="d-block py-4 px-3 text-light" href="{{ route('user.login') }}">Login</a></li>
                <li><a class="d-block py-4 px-3 text-light" href="{{ route('user.create') }}">Register</a></li>
            @endguest
        </ul>

    </div>
</nav>