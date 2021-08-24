<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $table = 'post_comments';

    public function user(){
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

    public function commentStore(Int $user_id,Array $data) {

        $this->user_id = $user_id;
        $this->post_id = $data['post_id'];
        $this->comment = $data['comment_form_post'];
        $this->event_at = now();

        $this->save();

        return;
    }


}
