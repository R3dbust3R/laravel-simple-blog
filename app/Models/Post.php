<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'image', 'user_id' 
    ];

    /**
     * User - Post relationship
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Post - Comment relationship
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Like - Post relationship
     */
    public function likes() {
        return $this->hasMany(Like::class);
    }

}
