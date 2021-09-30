<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use App\Models\posts\PostSubCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\ActionLogs\ActionLog;
use Illuminate\Support\Facades\DB;
use App\Models\Users\User;
use App\Models\Posts\Post;
use Auth;
use Carbon\Carbon;

class PostCommentsController extends Controller
{
    //


    public function comment(Request $request,PostComment $PostComment,$id) {

        $user = auth()->user();

        $list = Post::where('posts.id',$id)
        ->leftJoin('users', 'users.id', '=' , 'posts.user_id')
        ->leftJoin('post_comments','users.id','=','post_comments.user_id')
        ->leftJoin('post_sub_categories','posts.post_sub_category_id','=','post_sub_categories.id')
        ->select('posts.id','username','title','posts.event_at','sub_category','posts.user_id')
        ->withCount('likes')->orderBy('id','desc')
        ->first();



        $comment_count = DB::table('posts')
        ->where('posts.id',$id)
        ->leftJoin('post_comments','posts.id','=','post_comments.post_id')
        ->select('posts.id',DB::raw("count(post_comments.post_id) as count"))
        ->groupBy('posts.id')
        ->get();

        $comment = PostComment::where('post_comments.post_id',$id )
            ->leftJoin('users','post_comments.user_id','=','users.id')
            ->orderBy('post_comments.created_at','desc')
            ->select('post_comments.id','users.username','post_comments.event_at','post_comments.comment','post_comments.user_id','post_comments.post_id')
            ->withCount('comment_likes')->orderBy('id','desc')
            // ->first();
            ->get();

            $date = carbon::now();

        if($id !== null) {
            \DB::table('action_logs')->insert([
                'post_id' => $id,
                'user_id' => Auth::user()->id,
                'created_at' => $date,
                'event_at' => $date,
                'updated_at' => $date
            ]);
        }

        $count = \DB::table('action_logs')
            ->where('post_id',$id)
            ->count();


        return view('login.post_comment',['list'=>$list,'comment'=>$comment,'id'=>$id,'comment_count'=>$comment_count,'user'=>$user,'count'=>$count]);
    }

    public function create_comment(Request $request,PostComment $PostComment,$id) {

        $user = auth()->user();
        $data = $request->all();


        $validator = Validator::make($data, [
            'post_id' =>['required', 'integer'],
            'comment_form_post'     => ['required', 'string', 'max:140']
        ]);

        $validator->validate();

        $PostComment->commentStore($user->id,$data);

        return back();
    }

    public function edit(Request $request ,$id) {

        $category = new PostSubCategory;
        $categories = $category->getLists()->prepend('','');

        $list = \DB::table('posts')
        ->where('posts.id',$id)
        ->leftJoin('users', 'users.id', '=' , 'posts.user_id')
        ->leftJoin('post_comments','users.id','=','post_comments.user_id')
        ->select('posts.id','posts.title','posts.post')
        ->first();




        return view('login.edit',['categories'=>$categories,'list'=>$list]);
    }

    public function update(Request $request){

        $category_id = $request->input('category_id');
        $title = $request->input('title_update');
        $post = $request->input('post_update_form');
        $id = $request->input('posts_id');

        \DB::table('posts')
            ->where('id',$id)
            ->update([
                'post_sub_category_id'=>$category_id,
                'title'=>$title,
                'post'=>$post,
                'updated_at'=>now(),
            ]);

        return redirect('/top');
    }

    public function delete(Request $request,$id){

        \DB::table('posts')
            ->where('id',$id)
            ->delete();

        return redirect('/top');
    }

    public function comment_edit($id) {

        $category = new PostSubCategory;
        $categories = $category->getLists()->prepend('','');

        $list = \DB::table('post_comments')
        ->where('id',$id)
        ->get();

        return view('login.comment_edit',['categories'=>$categories,'list'=>$list]);
    }

    public function comment_update(Request $request) {

        $id = $request->input('comment_id');
        $comment = $request->input('comment_update_form');

        \DB::table('post_comments')
            ->where('id',$id)
            ->update([
                'comment' => $comment,
                'updated_at' => now(),
            ]);

        return redirect('/top');
    }

    public function comment_delete(Request $request,$id) {

        \DB::table('post_comments')
            ->where('id',$id)
            ->delete();

        return redirect('/top');
    }
}
