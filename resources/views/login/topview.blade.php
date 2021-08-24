@extends('layouts.top')

<link rel="stylesheet" href="css/topview.css">
<script src="https://kit.fontawesome.com/9cb59ee205.js" crossorigin="anonymous"></script>


  @section('content')

  <a class="title" href="/top">掲示板投稿一覧
  </a>

  <div class="posts">
    @foreach($search as $post)
      <div class="users_posts">
        <div class="view_count">
          <td>

             {{ $count }}view

          </td>
        </div>
        <div class="username">
        <td>
          {{$post->username}}さん
        </td>
      </div>
      <div class="updated_at">
        <td>
          {{Carbon\Carbon::parse($post->event_at)->format('Y年m月d日')}}
        </td>
      </div>
      <div class="post">
        <a class="post-view" href="/post/{{$post->id}}">
         {{$post->title}}
        </a>

      </div>
      <div class="sub_category">
        <!-- サブカテゴリー -->
        {{$post->sub_category}}
      </div>
      <div class="comment">
        <td>
          コメント数
          {{ $post->count }}
        </td>
      </div>
      <div class="likes">

        <td>
{{--
          @if($like_model->like_exist(Auth::user()->id,$post->id))
<p class="favorite-marke">
  <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}">❤️</a>
  <span class="likesCount">{{$post->post_favorite_count}}</span>
</p>
@else
<p class="favorite-marke">
  <a class="js-like-toggle" href="" data-postid="{{ $post->id }}">💔</a>
  @if($post->post_favorite_count === null)
    <span class="likesCount"></span>
  @else
  <span class="likesCount">{{$post->post_favorite_id->count}}</span>
  @endif
</p>
@endif --}}
​
        </td>
      </div>

      </div>


    @endforeach
  </div>



<div class="side-bar">

  <div class="admin">
    @if ($user->admin_role ===1)
    <a class="create_category" type="button" href="/create_category">カテゴリーを追加</a>
    @else

    @endif
  </div>
  <div class="side_contents">

  <a class="posts_create" type="button" href="/posts">投稿</a>
  {{ Form::open()}}
  <div class="search">

    {{ Form::input('text','search_post',null,['class' => 'search']) }}
  <div class="search_btn">
    {{ Form::submit('検索') }}
  </div>
  </div>
  {{ Form::close() }}

  <a class="favorite_posts" type="button" href="/posts">いいねした投稿</a>

  <a class="my_posts" type="button" href="/my_post">自分の投稿</a>
  </div>
</div>


  <div class="bar_category">
    <p class="category">カテゴリー
      <p class="main_category">
      @foreach($main_categories as $main)
      <p class="main_categories">
        {{$main->main_category}}<br>
      </p>
      @endforeach
      </p>
      <p class="sub_category">
        @foreach( $sub_categories as $sub)
        <p class="sub_categories">
          {{$sub->sub_category}}<br>
        </p>
        @endforeach
        </p>
      </p>
  </div>

  @endsection
