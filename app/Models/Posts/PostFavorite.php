<?php

namespace App\Models\Posts;


use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\post;

class PostFavorite extends Model
{
    protected $table = 'post_favorites';

    protected $fillable = [
        'user_id',
        'post_id',
    ];
    public $timestamps = false;

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

}
