<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;

        $validated = $request->validate([
            'comment' => ['required', 'min:5'],
            'user_id' => ['required'],
            'post_id' => ['required'],
        ]);

        $comment = new Comment($validated);

        if ($comment->save()) {
            return redirect()->back()->with('message', 'You published a new comment!');
        } else {
            return redirect()->back()->with('message', 'There was an error while trying to publish you comment, please try again!');
        }


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request['user_id'] = $comment->user_id;
        $request['post_id'] = $comment->post_id;

        $validated = $request->validate([
            'comment' => ['required', 'string', 'min:5'],
            'user_id' => ['required', 'integer'],
            'post_id' => ['required', 'integer'],
        ]);

        if ($comment->update($validated)) {
            return redirect()->back()->with('message', 'You comment has been updated!');
        } else {
            return redirect()->back()->with('message', 'There was an error while trying to update you comment, please try again!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->delete()) {

            return redirect()
                ->route('user.show', $comment->user_id)
                ->with('message', 'Comment has been deleted!');
            
        } else {
            
            return redirect()->back()->with('message', 'There was an error while trying to delete your comment, try again later!');

        }
    }
}
