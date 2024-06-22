<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
// use App\Http\Requests\StorePostRequest;
// use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // redirect to login page if not authenticated 
        if (! Auth::user()) {
            return redirect()->route('user.login');
        }

        $posts = Post::with(['user', 'comments'])->orderBy('id', 'desc')->paginate(6);
        return view('post.index', compact('posts'));
    }

    /**
     * Search for posts
     */
    public function search(Request $request) 
    {
        $query = $request->input('query');
        $posts = Post::with(['user', 'comments'])
                ->where('title', 'like', '%'. $query .'%')
                ->orWhere('content', 'like', '%'. $query .'%')
                ->latest()
                ->paginate(6);

        return view('post.search', compact('posts', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:500', 'unique:posts,title'],
            'content' => ['required', 'min:5', 'max:50000', 'unique:posts,content'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,avif,webp', 'max:5120'],
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('post_images', 'public');
        }
        
        // Create a new Post instance and fill it with validated data
        $post = new Post([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $image,
            'user_id' => Auth::user()->id,
        ]);

        if ($post->save()) {
            return redirect()->route('post.create')->with('message', 'Post published successfuly!');
        } else {
            return redirect()->route('post.create')->with('message', 'There was an error while trying to publish your post, please try again later!');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = Comment::with('user')
                        ->where('post_id', $post->id)
                        ->latest()
                        ->get();

        $latest_posts = Post::latest()->paginate(5);

        return view('post.show', compact('post', 'comments', 'latest_posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:500'],
            'content' => ['required', 'min:5', 'max:50000'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,avif,webp', 'max:5120'],
        ]);

        // Handle the profile image
        if ($request->hasFile('image')) {
            // If there's an existing image, delete it
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            // Store the new image and get its path
            $image = $request->file('image')->store('post_images', 'public');
            $validated['image'] = $image;
        }

        // Update the user with validated data
        if ($post->update($validated)) {

            return redirect()->route('post.edit', $post->id)->with('message', 'Post updated successfully!');

        } else {

            return redirect()->back()->withErrors('image', 'There was an error while trying to update your post\'s info, please try again!');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('user.show', Auth::user()->id)->with('message', 'Post has been deleted successfully.');
    }
}
