<?php

namespace App\Models\Posts;


use Illuminate\Database\Eloquent\Model;

class PostFavorite extends Model
{
    protected $table = 'post_favorites';

    protected $fillable = [
        'user_id',
        'post_id',
    ];
    public $timestamps = false;

    public function user() {

        return $this->belongsTo(user::class);
    }

    public function posts() {
        return $this->belongsTo(post::class);
    }

    public function like_exist($id,$post_id) {
        $exist = PostFavorite::where('user_id', '=', $id)->where('post_id', '=' , $post_id)->get();

        if(!$exist->isEmpty()) {
            return true;
        }else{
            return false;
        }
    }


}
