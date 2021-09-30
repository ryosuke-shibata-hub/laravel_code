<?php

namespace App\Models\Users;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Posts\post;
use  App\Models\Posts\PostFavorite;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostCommentFavorite;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function posts() {
        return $this->hasMany(post::class);
    }

    // public function like_products()
    // {
    //     return $this->hasMany(PostFavorite::class);
    // }

    public function likes() {
        return $this->hasMany(PostFavorite::class);
    }

    public function comment_likes() {
        return $this->hasMany(PostCommentFavorite::class);
    }


}
