<nav class="navbar bg-dark text-light py-2">
    <div class="container">

        <div class="logo">
            <strong class="fs-4">
                <a class="text-light" href="{{ route('post.index') }}">Back<span class="text-warning">book</span></a>
            </strong>
        </div>

        <div class="nav-search">
            <form 
                action="{{ route('post.search') }}"
                method="GET"
                class="">
                <div class="input-group">
                    <input type="submit" value="Find" class="btn btn-warning px-4">
                    <input type="text" required placeholder="Search for posts" class="form-control border-warning" name="query">
                </div>
            </form>
        </div>

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