<?php

namespace App\Models\Posts;
use  App\Models\Posts\PostFavorite;
use App\Models\Posts\PostCommentFavorite;
use App\Models\Posts\PostComment;
use App\Models\ActionLogs\ActionLog;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use Auth;

class Post extends Model
{


    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',


    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function users() {
      return $this->belongsToMany(User::class);
    }

    public function PostComment() {
      return $this->hasMany(PostComment::class);
    }

    // public function PostFavorite(){
    //   return $this->hasMany(PostFavorite::class);
    // }

    // public function like_products() {
    //   return $this->hasMany(PostFavorite::class,'post_id','id');
    // }

    public function likes() {
      return $this->hasMany(PostFavorite::class);
    }

    // public function isLikedBy_comment($user): bool {
    //   return PostCommentFavorite::where('user_id',$user->id)->where('post_comment_id',$this->id)->first() !==null;
    // }

     public function isLikedBy($user): bool {
      return PostFavorite::where('user_id',$user->id)->where('post_id',$this->id)->first() !==null;
    }


    // public function comment_like_products() {
    //   return $this->hasMany(PostCommentFavorite::class,'post_comment_id','id');
    // }

    public function view_count() {

      return $this->hasMany(ActionLog::class,'post_id');
    }



}
