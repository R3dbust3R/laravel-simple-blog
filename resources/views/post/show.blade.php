<x-layout :page="$post->title">


    <div class="container">
        
        <div class="post bg-light mt-4 p-5">
            <h2>{{ $post->title }}</h2>
            <span class="text-muted">{{$post->created_at->DiffForHumans()}}</span>

            <img 
                src="{{ asset('storage/' . ($post->image ?? 'images/banner.jpg')) }}" 
                alt="{{ $post->title }}"
                class="w-100">

            <p class="lead">
                {{ $post->content }}
            </p>

            @if ($post->user_id == Auth::user()->id)
                <div class="actions text-right">
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-success">Edit post</a>
                    <form 
                        action="{{ route('post.destroy', $post->id) }}"
                        method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <input 
                            onclick="return confirm('Are you sure that you want to delete this post?')" 
                            class="btn btn-sm btn-danger" 
                            type="submit" 
                            name="submit"
                            value="Delete post">
                    </form>
                </div>
            @endif
        </div>

    </div>
    


</x-layout>