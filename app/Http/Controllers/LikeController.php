<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    
    public function like($post_id) {

        $user_id = Auth::id();

        $existingLike = Like::where('user_id', $user_id)
                        ->where('post_id', $post_id)
                        ->first();

        if ($existingLike) {
            
            $existingLike->delete();

        } else {
            
            $like = new Like();
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->save();
        }

        return redirect()->back();

    }

    public function index() {

    }

    public function show() {

    }

    public function create() {

    }

    public function store() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }

}
