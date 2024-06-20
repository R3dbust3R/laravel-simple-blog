<x-layout page="Create">


    <div class="container">
        <h1 class="text-center mt-3">Login</h1>
        <form action="{{ route('user.check-login') }}" method="POST" class="w-50 m-auto">
            @csrf
            
            <div class="form-group mb-3">
                <label class="mb-2" for="email">Email</label>
                <input type="text" id="email" class="form-control" name="email">
            </div>

            <div class="form-group mb-3">
                <label class="mb-2" for="password">Password</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>

            @session('email')
                <div class="form-group mb-3 error text-danger">
                    {{ session('email') }}
                </div>
            @endsession
            
            <div class="form-group mt-4">
                <input type="submit" value="Login" class="btn btn-primary btn-block w-100" name="submit">
            </div>
            

        </form>
    </div>


</x-layout>