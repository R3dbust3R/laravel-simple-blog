<x-layout page="Home">


    <div class="container">
        <h2 class="my-5">Latest Posts</h2>
        @foreach ($posts as $post)
            <div class="single-post border border-2 rounded-4 bg-light p-4 mb-3">
                <div class="row">
                    
                    <div class="col-4">
                        <img 
                        src="{{ asset('storage/' . ($post->image ?? 'images/banner.jpg')) }}" 
                        alt="{{ $post->title }}"
                        class="d-block w-100 img-thumbnail rounded-4">
                    </div>

                    <div class="col-8">
                        <h4>
                            <a href="{{ route('post.show', $post->id) }}">
                                {{$post->title}}
                            </a>
                        </h4>
                        <span class="poblisher">
                            Published by: 
                            <a href="{{ route('user.show', $post->user->id) }}">
                                <img 
                                    src="{{ asset('storage/' . ($post->user->image ?? 'images/default.jpg')) }}" 
                                    alt="{{ $post->user->name }}"
                                    style="width: 28px; top: -2px"
                                    class="rounded-circle position-relative">
                                {{$post->user->name}}
                            </a>, 
                            {{$post->created_at->DiffForHumans()}}
                        </span>
                        <p class="lead">
                            {{Str::words($post->content, 45)}}
                            <a href="{{ route('post.show', $post->id) }}">more</a>
                        </p>

                        {{-- owner actions --}}
                        @if ($post->user_id == Auth::user()->id)
                            <div class="actions text-right">
                                {{-- <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-primary">Show post</a> --}}
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
                        {{-- owner actions --}}
                    </div>

                </div>
            </div>
        @endforeach
        {{-- pagination --}}
        <div class="pagination">
            {{ $posts->links() }}
        </div>
        {{-- pagination --}}
    </div>
    


</x-layout>