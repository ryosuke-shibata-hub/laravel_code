<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\post;
use App\Models\Posts\PostComment;
use App\Models\ActionLogs\ActionLog;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';

    protected $fillable = [
        'user_id',
        'post_comment_id',
    ];

    public $timestamps = false;

    public function user() {

        return $this->belongsTo(User::class);
    }

    // public function post() {
    //     return $this->belongsTo(Post::class);
    // }

    public function PostComment() {
        return $this->belongsTo(PostComment::class);
    }

    // public function view_count() {

    //     return $this->hasMany(action_logs::class);
    // }

    // public function likes() {
    //   return $this->hasMany(PostFavorite::class);
    // }

    // public function isLikedBy_comment($user): bool {
    //   return PostFavorite::where('user_id',$user->id)->where('post_id',$this->id)->first() !==null;
    // }
}
