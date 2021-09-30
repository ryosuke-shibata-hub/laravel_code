@extends('layouts.top')

<link rel="stylesheet" href="{{ asset('css/post_comment.css') }}">

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://kit.fontawesome.com/9cb59ee205.js" crossorigin="anonymous">
</script>

<script src="{{ asset('/js/my_js/ajaxlike.js') }}" defer></script>

<script src="{{ asset('/js/my_js/ajaxlike_comment.js') }}" defer></script>

@section('content')

<div class="title">
    <h2>投稿詳細画面</h2>
    <a class="back" href="/top">もどる</a>
</div>

<div class="post">
  <div class="view-count">
        {{ $count }}view
  </div>

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
        <p class="subcategory_block">
        {{ $list->sub_category }}
        </p>
      </div>
      @foreach($comment_count as $count)
        <div class="comment">
          コメント数
          {{ $count->count }}
        </div>
      @endforeach
       <div class="likes">
       @if(!$list->isLikedBy(Auth::user()))
           <span class="likes">
        <i class="fas fa-heart like-toggle" data-post-id="{{ $list->id }}"></i>
      <span class="like-counter">{{$list->likes_count}}</span>
    </span><!-- /.likes -->
  @else
    <span class="likes">
        <i class="fas fa-heart like-toggle liked" data-post-id="{{ $list->id }}"></i>
      <span class="like-counter">{{$list->likes_count}}</span>
    </span><!-- /.likes -->
  @endif
      </div>
    </div>
  </div>

</div>
    <div class="comment_user">
      @foreach($comment as $comment)
      <div class="comment_edit">
         @if(Auth::user()->id === $comment->user_id)
        <a class="edit_comment" href="/comment_edit/{{$comment->id}}">編集</a>
      @elseif($user->admin_role ===1)
        <a class="edit_comment" href="/comment_edit/{{$comment->id}}">編集</a>
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
      {{-- @if(auth()->user())
        @if(isset($comment->like_product_comment[0]))
        <p class="unlike">
          <a class="toggle_wish_comment" post_comment_id="{{ $comment->id }}" like_product_comment="1"><i class="fas fa-heart-broken" ></i>
            {{-- <span class="like_count">
              {{ $comment->like_product_comment }}
            </span> --}}
          {{-- </a>
        </p>
          @else
          <p class="like">
             <a class="toggle_wish_comment" post_comment_id="{{ $comment->id }}" like_product_comment="0"><i class="fas fa-heart"></i> --}}
              {{-- <span class="like_count">
              {{ $comment->like_product_comment}}
            </span> --}}
          {{-- </a>
          </p>
          @endif
          @endif --}}

          @if(!$comment->isLikedBy_comment(Auth::user()))
           <span class="likes">
        <i class="fas fa-heart comment-like-toggle" data-comment-id="{{ $comment->id }}"></i>
      <span class="comment_like_counter">{{$comment->comment_likes_count}}</span>
    </span><!-- /.likes -->
  @else
    <span class="likes">
        <i class="fas fa-heart comment-like-toggle liked" data-comment-id="{{ $comment->id }}"></i>
      <span class="comment_like_counter">{{$comment->comment_likes_count}}</span>
    </span><!-- /.likes -->
  @endif
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
