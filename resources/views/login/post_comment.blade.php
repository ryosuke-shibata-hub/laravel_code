@extends('layouts.top')

<link rel="stylesheet" href="{{ asset('css/post_comment.css') }}">
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">

@section('content')

<div class="title">
    <h2>投稿詳細画面</h2>
    <a class="back" href="/top">もどる</a>
</div>



<div class="post">
  <div class="view-count">
        {{ $count }}view
  </div>
    @foreach($list as $list)
    <div class="users_posts">
      <div class="username">
        {{$list->username}}さん
      </div>
      @if(Auth::user()->id === $list->user_id)
        <a class="edit_posts" href="/edit/{{$id}}">編集</a>
      @elseif($user->admin_role ===1)
        <a class="edit_posts" href="/edit/{{$id}}">編集</a>
      @endif
      <div class="updated_at">
        {{Carbon\Carbon::parse($list->event_at)->format('Y年m月d日')}}
      </div>

      <div class="post_title">
        {{$list->title}}
      </div>
      <div class="post-detail">
        {{$list->post}}
      </div>
      <div class="subcategory">
        サブカテゴリー
      </div>
      @foreach($comment_count as $count)
        <div class="comment">
          コメント数
          {{ $count->count }}
        </div>
      @endforeach
      <div class="like">
        ❤️
      </div>
    </div>
    @endforeach


    <div class="comment_user">
      @foreach($comment as $comment)
      <div class="comment_edit">
         @if(Auth::user()->id === $comment->user_id)
        <a class="edit_comment" href="/comment_edit/{{$comment->id}}">編集</a>
      @elseif($user->admin_role ===1)
        <a class="edit_comment" href="/edit/{{$comment->id}}">編集</a>
      @endif

      </div>
      <div class="comment_posts">
        <div class="comment_username">
          <td>
            {{$comment->username}}
          </td>
        </div>
        <div class="comment_date">
          <td>
             {{Carbon\Carbon::parse($comment->event_at)->format('Y年m月d日')}}
          </td>
        </div>
        <div class="user_comment">
          <td>
            {{$comment->comment}}
          </td>
        </div>
        <div class="comment_like">
          <td>
            ❤️2
          </td>
        </div>
      </div>
      @endforeach
    </div>

    <div class="comment_form">
      {{ Form::open() }}
      <div class="comment_form_text">
        {!! Form::input('text','comment_form_post',null,['class'=>'input','placeholder'=>'コメントを記入してください！'])!!}
      </div>
      <div class="post_user_id">
        {{ Form::hidden('user_id',Auth::user()->id) }}
      </div>
      <div class="post_id">
        {{ Form::hidden('post_id',$id) }}
      </div>
      <div class="comment-btn">
        {{ Form::submit('コメント') }}
      </div>
      {{  Form::close()  }}

    </div>
</div>

@endsection
