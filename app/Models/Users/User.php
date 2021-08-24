<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

        return $this->hasMany(Post::class);
    }

    public function PostFavorite() {

        return $this->hasMany(PostFavorite::class);
    }
}
