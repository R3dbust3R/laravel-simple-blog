<x-layout page="Create">


    <div class="container">
        <div class="profile bg-light border border-2 rounded text-center">
            <div class="header">
                <div class="banner"></div>
                <img 
                    src="{{ asset('storage/' . ($user->image ?? 'images/default.jpg')) }}" 
                    alt="{{ $user->name }}" 
                    class="profile-img img-thumbnail rounded-circle">
            </div>
            <div class="body">
                <h3 class="name"> {{ $user->name }} </h3>
                <p class="m-0 p-0"> Member since: {{ $user->created_at->DiffForHumans() }} </p>
            </div>
            <div class="footer pb-5 mt-2">
                @if ($hasAccess)
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                    <a href="{{ route('post.create') }}" class="btn btn-success">Add New Post</a>
                    <form
                        onsubmit="return confirm('Are you sure that you want to delete your account?, Remember that you will not recover it later!')" 
                        action="{{route('user.destroy', $user->id)}}" 
                        method="POST" 
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete Account" class="btn btn-danger">
                    </form>
                @endif
            </div>
        </div>
        <div class="posts single-post">
            <h3 class="my-5 name">{{$user->name}}'s Posts</h3>
            
            @session('message')
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>    
            @endsession

            @foreach ($posts as $post)
                <div class="post border border-2 bg-light p-3 rounded-3 mb-3">
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
                                    {{ $post->title }}
                                </a>
                            </h4>
                            <span>{{ $post->created_at->DiffForHumans() }}</span>
                            <p class="lead">
                                {{ Str::words($post->content, 45) }}
                            </p>
                            @if ($hasAccess)
                                <div class="actions text-right">
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-primary">Show post</a>
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
                </div>
            @endforeach
            {{-- pagination --}}
            <div class="pagination">
                {{ $posts->links() }}
            </div>
            {{-- pagination --}}
        </div>
    </div>


</x-layout>