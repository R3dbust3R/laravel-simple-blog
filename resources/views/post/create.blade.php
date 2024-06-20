<x-layout page="Create new post">

    <div class="container">
        <h2 class="text-center">Create a new post</h2>

        @session('message')
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endsession

        <form 
            action="{{ route('post.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="w-75 m-auto">
            @csrf

            <div class="form-group mb-3">
                <label class="mb-2" for="title">Title</label>
                <input type="text" value="{{ old('title') }}" id="title" class="form-control" name="title">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="mb-2" for="title">Content</label>
                <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="mb-2" for="image">Post thumbnail</label>
                <input type="file" id="image" class="form-control" name="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <input type="submit" value="Publish" class="btn btn-primary btn-block w-100" name="submit">
            </div>

        </form>
    </div>

</x-layout>