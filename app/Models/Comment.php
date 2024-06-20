<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment', 'user_id', 'post_id' 
    ];

    /**
     * User - Comment relationship
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Post - Comment relationship
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }

}
