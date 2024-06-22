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

                        {{-- comments, likes, shares section --}}
                        <div class="d-flex justify-content-between">
                            <div class="for-user mb-2">

                                @foreach ($post->likes as $like)
                                    @if ($like->user_id == Auth::id())
                                        @php
                                            $liked = true; break;    
                                        @endphp
                                    @endif
                                @endforeach

                                <a href="{{ route('post.like', $post->id) }}" class="d-inline-block m-2"><i class="fa-{{ $liked ? 'solid' : 'regular' }} fa-heart fs-5"></i></a>
                                <a href="{{ route('post.show', $post->id) }}#add-comment" class="d-inline-block m-2"><i class="fa-regular fa-comment fs-5"></i></a>
                                <a href="#######" class="d-inline-block m-2"><i class="fa-regular fa-share-from-square fs-5"></i></a>

                                @php
                                    $liked = false;
                                @endphp
                            </div>

                            <div class="text-muted comments-counter mb-3 counters">
                                <a href="{{ route('post.show', $post->id) }}#post-comments" class="badge bg-primary text-light">
                                    {{ $post->comments->count() }} Comments
                                </a>
                                <span class="badge bg-dark">
                                    {{ $post->likes->count() }} Likes
                                </span>
                            </div>
                        </div>
                        {{-- comments, likes, shares section --}}

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