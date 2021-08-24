@extends('layouts.top')
  <link rel="stylesheet" href="css/my_post.css">

@section('content')
<div class="title">
    <h2>自分の投稿</h2>
    <a class="back" href="/top">もどる</a>
</div>
<div class="posts">
@foreach($list as $user)
<div class="users_posts">
        <div class="view_count">
          <td>
            view
          </td>
        </div>
        <div class="username">
        <td>
          {{$user->username}}さん
        </td>
      </div>
      <div class="updated_at">
        <td>
          {{Carbon\Carbon::parse($user->event_at)->format('Y年m月d日')}}
        </td>
      </div>
      <div class="post">
        <td>
          {{$user->title}}
        </td>
      </div>
      <div class="sub_category">
        <!-- サブカテゴリー -->
        {{$user->sub_category}}
      </div>
      <div class="comment">
        <td>
          コメント数
        </td>
      </div>
      </div>
@endforeach
</div>
@endsection
