<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\post;
use Auth;

class PostComment extends Model
{
    protected $table = 'post_comments';

    public function users(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];

    public function posts() {
      return $this->belongsTo(post::class);
    }

    public function commentStore(Int $user_id,Array $data) {

        $this->user_id = $user_id;
        $this->post_id = $data['post_id'];
        $this->comment = $data['comment_form_post'];
        $this->event_at = now();

        $this->save();

        return;
    }

    public function isLikedBy_comment($user): bool {
      return PostCommentFavorite::where('user_id',$user->id)->where('post_comment_id',$this->id)->first() !==null;
    }


    public function comment_likes() {
       return $this->hasMany(PostCommentFavorite::class);
    }

//     public function is_liked_by_auth_user()
//   {
//     $id = Auth::id();

//     $likers = array();
//     foreach($this->comment_likes as $like) {
//       array_push($likers, $like->user_id);
//     }

//     if (in_array($id, $likers)) {
//       return true;
//     } else {
//       return false;
//     }
// }

}
