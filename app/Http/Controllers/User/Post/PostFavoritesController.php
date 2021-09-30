<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\post;
use Illuminate\Support\Facades\Auth;

class PostFavoritesController extends Controller
{
    public function like(Request $request) {
        $user_id = Auth::user()->id;
        $post_id = $request->post_id;
        $liked = PostFavorite::where('user_id',$user_id)->where('post_id',$post_id)->first();

        if(!$liked) {
            $like = new PostFavorite;
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        }else{
            PostFavorite::where('post_id',$post_id)->where('user_id',$user_id)
            ->delete();
        }

        $post_likes_count = post::withCount('likes')->findOrFail($post_id)->likes_count;

        $param = [
            'post_likes_count' => $post_likes_count,
        ];

        return response()->json($param);
    }
}
