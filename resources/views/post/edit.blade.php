<x-layout page="Create new post">

    <div class="container">
        <div class="bg-light">
            <h2 class="text-center my-4">Edit post</h2>

            @session('message')
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endsession

            <form 
                action="{{ route('post.update', $post->id) }}" 
                method="POST" 
                enctype="multipart/form-data"
                class="w-75 m-auto">
                
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label class="mb-2" for="title">Title</label>
                    <input type="text" value="{{ old('title') ?? $post->title }}" id="title" class="form-control" name="title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="mb-2" for="title">Content</label>
                    <textarea class="form-control" name="content" id="content">{{ old('content') ?? $post->content }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="mb-2" for="image">Post thumbnail</label>
                    <input type="file" id="image" class="form-control" name="image">
                    <div class="current-image my-3 w-25">
                        <img 
                            src="{{ asset('storage/' . $post->image) }}" 
                            alt="{{ $post->image }}" 
                            class="d-block w-100 rounded-4">
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