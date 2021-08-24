<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\posts\PostSubCategory;
use Auth;
use Carbon\Carbon;

class PostSubCategoriesController extends Controller
{
    //

    public function create(Request $request) {

        $category = new PostSubCategory;
        $categories = $category->getLists()->prepend('','');


        return view('login.posts',['categories'=>$categories]);
    }

    public function posts_create(Request $request) {

        $post = $request->input('contents');
        $title = $request->input('title');
        $category_id = $request->input('category_id');
        $time = carbon::now();



        \DB::table('posts')->insert([
            'post' => $post,
            'title' => $title,
            'post_sub_category_id' => $category_id,
            'user_id' => Auth::user()->id,
            'updated_at' => $time,
            'created_at' => $time,
            'event_at' => $time,

        ]);

        return redirect('/top');
    }
}
