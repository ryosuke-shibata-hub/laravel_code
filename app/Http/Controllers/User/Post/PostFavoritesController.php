<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\post;
use Illuminate\Support\Facades\Auth;

class PostFavoritesController extends Controller
{

    // public function like(Post $post, Request $request) {
    //     $like = new PostFavorite();
    //     $like->post_id=$post->id;
    //     $like->user_id=Auth::user()->id;
    //     $like->save();

    //     return back();
    // }

    // public function unlike(Post $post, Request $request) {
    //     $user=Auth::user()->id;
    //     $like=PostFavorite::where('post_id',$post->id)->where('user_id',$user)->first();
    //     $like->delete();

    //     return back();
    // }

}
