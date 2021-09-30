@extends('layouts.top')

<link rel="stylesheet" href="css/topview.css">

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://kit.fontawesome.com/9cb59ee205.js" crossorigin="anonymous"></script>

<script src="{{ asset('/js/my_js/ajaxlike.js') }}" defer></script>

@section('content')



  <a class="title" href="/top">掲示板投稿一覧
  </a>

  <div class="posts">
    @foreach($search as $post)

      <div class="users_posts">
        <div class="view_count">

          <td>
            {{ $post->view_count->count() }}view
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
        <p class="subcategory_block">

        {{$post->sub_category}}
        </p>
      </div>
      <div class="comment">
        <td>
          コメント数
          {{ $post->count }}
        </td>
      </div>

      <div class="likes">

      {{-- @if(auth()->user())
        @if(isset($post->like_products[0]))
        <p class="unlike">
          <a class="toggle_wish" post_id="{{ $post->id }}" like_product="1"><i class="fas fa-heart-broken" ></i>
            <span class="like_count">
              {{ $post->post_likes_count }}
            </span>

          </a>
        </p>
          @else
          <p class="like">
             <a class="toggle_wish" post_id="{{ $post->id }}" like_product="0"><i class="fas fa-heart"></i>
              <span class="like_count">
              {{ $post->PostFavorite_count }}
            </span>
          </a>
          </p>


          @endif
          @endif --}}

          @if(!$post->isLikedBy(Auth::user()))
           <span class="likes">
        <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
      <span class="like-counter">{{$post->likes_count}}</span>
    </span><!-- /.likes -->
  @else
    <span class="likes">
        <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
      <span class="like-counter">{{$post->likes_count}}</span>
    </span><!-- /.likes -->
  @endif
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
    {{ Form::submit('検索',['class'=>'search_submit']) }}
  </div>
  </div>
  <div class="favorite_posts">
    {{-- {!! Form::hidden('id',Auth::user()->id)!!} --}}
    {{ Form::submit('いいねした投稿',["class"=>"search_my_favorite","name"=>"my_favorite","value"=>"my_favorite"]) }}
  </div>

  <div class="my_posts">
    {{-- {!! Form::hidden('id',Auth::user()->id)!!} --}}
    {{ Form::submit('自分の投稿',['class'=>'search_my_posts',"name"=>"my_post","value"=>"my_post"]) }}
  </div>
  {{-- {{ Form::close() }} --}}
</div>


  <div class="bar_category">
    <p class="category">カテゴリー</p>
       @foreach($main as $main)
      <div class="category_main_category">
      <p class="category_main_categories">

        {{$main->main_category}}<br>
      </p>
      </div>
      @foreach($main->PostSubCategory as $sub_category)
      <div class="category_sub_category">
        <p class="category_sub_categories">
        {{-- {!! Form::hidden('search_post',$sub_category->id) !!} --}}
        {{ Form::submit($sub_category->sub_category,(['name'=>'search_post','class'=>'sub_category_submit'])) }}<br>
        {{-- {{$sub_category->sub_category}}<br> --}}
        </p>
        </div>
      @endforeach
      @endforeach

  </div>
{{ Form::close() }}
  @endsection
