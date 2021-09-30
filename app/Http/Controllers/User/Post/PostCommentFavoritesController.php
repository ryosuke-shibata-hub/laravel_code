<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostCommentFavorite;
use App\Models\Posts\PostComment;
use Auth;

class PostCommentFavoritesController extends Controller
{

    public function post_comment_like(Request $request) {

        $user_id = Auth::user()->id;
        $post_comment_id = $request->post_comment_id;
        $liked = PostCommentFavorite::where('user_id',$user_id)->where('post_comment_id',$post_comment_id)->first();

        if(!$liked) {
            $like = new PostCommentFavorite;
            $like->post_comment_id = $post_comment_id;
            $like->user_id = $user_id;
            $like->save();
        }else{
            PostCommentFavorite::where('post_comment_id',$post_comment_id)->where('user_id',$user_id)
            ->delete();
        }

        $comment_likes_count = PostComment::withCount('comment_likes')->findOrFail($post_comment_id)->comment_likes_count;

        $param = [
            'comment_likes_count' => $comment_likes_count,
        ];

        return response()->json($param);
    }

}
