@extends('layouts.top')

<link rel="stylesheet" href="{{ asset('css/comment_edit.css') }}">
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">

@section('content')

<div class="title">
    <h2>投稿編集画面</h2>
    <a class="back" href="/top">もどる</a>
</div>
@foreach($list as $list)
{!! Form::open(['url'=>'/comment_update/{id}','method'=>'get']) !!}

<div class="comment_content">
    <div class="comment_detail_contents">
      <p class="comment_title">
        コメント
      </p>
      {!! Form::input('text','comment_update_form',null,(['class'=>'comment_form','placeholder'=>$list->comment])) !!}
    </div>
    <div class="update">
      {!! Form::hidden('comment_id',$list->id) !!}
      {!! Form::submit('更新') !!}
      {!! Form::close() !!}
    </div>

    <div class="delete">

    <a class="btn-delete" href="/comment_delete/{{$list->id}}" onclick="return confirm('このコメントを削除します。よろしいでしょうか？')">削除</a>
    </div>
  </div>
  @endforeach
@endsection
