<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostFavorite;
use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{
    //

    public function top(Request $request){



        $user = auth()->user();

        $main_categories = \DB::table('post_main_categories')
            ->get();
        $sub_categories = \DB::table('post_sub_categories')
            ->get();

        $search = $request->input('search_post');

        $query = post::query();

        if(!empty($search)) {
            $query = \DB::table('posts')
            ->where('title','like',"%{$search}%")
            ->orWhere('post','like',"%{$search}%")
            ->orWhere('sub_category','=',"{$search}");

        }

        $search = $query
        ->leftJoin('post_sub_categories', 'posts.post_sub_category_id','=','post_sub_categories.id')
        ->leftJoin('users', 'users.id', '=' , 'posts.user_id')
        ->leftJoin('post_comments','posts.id','=','post_comments.post_id')
        ->orderBy('posts.event_at','desc','created_at','desc')
        ->select('posts.id','username','title','posts.event_at','sub_category',DB::raw("count(post_comments.post_id) as count"))
        ->groupBy('posts.id')
        ->get();

        // $data=[];

        // $posts = post::withCount('PostFavorite')->orderBy('created_at','desc')->paginate(5);
        // $like_model = new PostFavorite;

        // $data = [
        //     'posts' => $posts,
        //     'like_model' => $like_model,
        // ];

        // $post_id = $request->$id;

        if(session()->has('count')){
            $count = session('count');
        }else{
            $count = 0;
        }

        $count++;
        session(['count' => "$count"]);



        return view('login.topview',['main_categories'=>$main_categories,'sub_categories'=>$sub_categories,'search'=>$search,'user'=>$user,'count'=>$count]);
    }

    public function my_post(){

        $user = Auth::user();

        $list = \DB::table('posts')
        ->leftJoin('users', 'users.id', '=' , 'posts.user_id')
        ->leftJoin('post_sub_categories', 'posts.post_sub_category_id','=','post_sub_categories.id')
        ->where('user_id','=',Auth::user()->id)
        ->orderBy('posts.id','desc','created_at','desc')
        ->get();

        return view('login.my_post',['list'=>$list]);
    }


    // public function like(Request $request) {



    //     $id = Auth::user()->id;
    //     $post_id = $request->post_id;
    //     $like = new PostFavorite;
    //     $post = Post::findOrFail($post_id);

    //     if ($like->like_exist($id,$post_id)) {
    //         $like = PostFavorite::where('post_id',$post_id)->where('user_id',$id)->delete();

    //     }else{
    //         $like = new PostFavorite;
    //         $like->post_id = $request->post_id;
    //         $like->user_id = Auth::user()->id;
    //         $like->save();
    //     }

    //    $postLikesCount = $post->loadCount('PostFavorite')->likes_count;
    //     $json = [
    //         'postLikeCount' => $postLikeCount,
    //     ];

    //     return response()->json($json);
    // }


}
