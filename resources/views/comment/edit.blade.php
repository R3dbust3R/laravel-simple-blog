<x-layout page="Edit comment">


    <div class="container">
        <div class="bg-light p-5 my-3 rounded">
            <h3>Edit Comment</h3>

            @session('message')
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endsession

            <form 
                action="{{ route('comment.update', $comment->id) }}"
                method="POST"
                class="edit-comment d-inline">

                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <textarea 
                        name="comment" 
                        style="height: 320px"
                        class="form-control">{{ old('comment') ?? $comment->comment }}</textarea>
                    
                    @error('comment')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="form-group d-inline">
                    <input type="submit" value="Update" name="submit" class="btn btn-primary px-5">
                </div>
            </form>

            <form 
                onsubmit="return confirm('Are you sure that you want to delete this comment?')"
                action="{{ route('comment.destroy', $comment->id)}}"
                class="d-inline"
                method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger px-5">
            </form>

        </div>
    </div>



</x-layout>