<x-layout page="Create">


    <div class="container">
        <div class="bg-light rounded-3 py-4">
            <h2 class="text-center my-4">Edit Profile</h2>
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="w-50 m-auto">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label class="mb-2" for="name">Name</label>
                    <input type="text" value="{{ old('name') ?? auth()->user()->name }}" id="name" class="form-control" name="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="mb-2" for="email">Email</label>
                    <input type="text" value="{{ old('email') ?? auth()->user()->email }}" id="email" class="form-control" name="email">
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
                    <div class="w-25 mt-2">
                        <img src="{{ asset('storage/' . ($user->image ?? 'images/default.jpg')) }}" alt="" class="w-100 rounded-3 current-image">
                    </div>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <input type="submit" value="Update" class="btn btn-primary btn-block w-100" name="submit">
                </div>
                

            </form>
        </div>
    </div>


</x-layout>