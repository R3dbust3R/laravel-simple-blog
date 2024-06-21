<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class social extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'facebook', 
        'instagram', 
        'tiktok', 
        'linkedin', 
        'github', 
        'google', 
        'youtube', 
        'website'
    ];

    /**
     * User - Social relationship
     */
    public function user() {
        return $this->hasOne(User::class);
    }



}
