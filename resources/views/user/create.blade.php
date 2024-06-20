<x-layout page="Create">


    <div class="container">
        <h1 class="text-center mt-3">Register</h1>
        <form 
            action="{{ route('user.store') }}" 
            method="POST" 
            enctype="multipart/form-data" 
            class="w-50 m-auto">
            @csrf
            
            <div class="form-group mb-3">
                <label class="mb-2" for="name">Name</label>
                <input type="text" value="{{ old('name') }}" id="name" class="form-control" name="name">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="mb-2" for="email">Email</label>
                <input type="text" value="{{ old('email') }}" id="email" class="form-control" name="email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="mb-2" for="password">Password</label>
                <input type="password" id="password" class="form-control" name="password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="mb-2" for="password_confirmation">Password Confirmation</label>
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
            </div>

            <div class="form-group mb-3">
                <label class="mb-2" for="image">Profile image</label>
                <input type="file" id="image" class="form-control" name="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <input type="submit" value="Register" class="btn btn-primary btn-block w-100" name="submit">
            </div>
            

        </form>
    </div>


</x-layout>