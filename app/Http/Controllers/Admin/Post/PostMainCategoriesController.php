<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\posts\PostMainCategory;

class PostMainCategoriesController extends Controller
{
    //
    public function create_category(){


        $category = new PostMainCategory;
        $categories = $category->getLists()->prepend('','');


        return view('login.create_category',['categories'=>$categories]);
    }

    public function create_main_category(Request $request) {

        $main_category = $request->input('main_category');
        $time = carbon::now();
        $sub_category = $request->input('sub_category');



        if(!empty($main_category)){
             \DB::table('post_main_categories')->insert([
            'main_category' => $main_category,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        }elseif(!empty($sub_category)){

            $select_main_category = $request->category_id;

             \DB::table('post_sub_categories')->insert([
            'sub_category' => $sub_category,
            'post_main_category_id' => $select_main_category,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        }else{
            return back();
        }




        return back();
    }
}
