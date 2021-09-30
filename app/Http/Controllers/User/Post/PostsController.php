<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostMainCategory;
use App\Models\posts\PostComment;
use App\Models\Posts\PostFavorite;
use App\Models\ActionLogs\ActionLog;
use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{
    //

    public function top(Request $request){

        $user = auth()->user();

        $main = PostMainCategory::with('PostSubCategory:post_main_category_id,sub_category')
        ->get();

        $search = $request->input('search_post');

        $search_posts = $request->input('my_post');

        $search_my_favorite = $request->input('my_favorite');

        $category_lists = $request->input('select_subcategory');

        $category = PostMainCategory::with('subcategory');


        $query = post::query();

        if(!empty($search)) {
            $query = post::where('title','like',"%{$search}%")
            ->orWhere('post','like',"%{$search}%")
            ->orWhere('username','like',"%{$search}%")
            ->orWhere('sub_category','=',"{$search}");

        }elseif(!empty($search_posts)) {
            $query = post::where('posts.user_id','=',Auth::user()->id);

        }elseif(!empty($search_my_favorite)) {

        $query = post::whereHas('likes');

        }

        $search = $query
        ->leftJoin('post_sub_categories', 'posts.post_sub_category_id','=','post_sub_categories.id')
        ->leftJoin('users', 'users.id', '=' , 'posts.user_id')
        ->leftJoin('post_comments','posts.id','=','post_comments.post_id')
        ->select('post_sub_category_id','posts.id','username','title','posts.event_at','sub_category',DB::raw("count(post_comments.post_id) as count"))
        ->orderBy('posts.event_at','desc','created_at','desc')
        ->groupBy('posts.id')
        ->withCount('likes')->orderBy('id','desc')
        ->get();


        return view('login.topview',['search'=>$search,'user'=>$user,'category'=>$category,'main'=>$main,]);
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



}
