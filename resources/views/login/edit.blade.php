@extends('layouts.top')

<link rel="stylesheet" href="{{ asset('/css/edit.css') }}">
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">

@section('content')

<div class="title">
    <h2>投稿編集画面</h2>
    <a class="back" href="/top">もどる</a>
</div>

{!! Form::open(['url'=>'/update/{id}','method'=>'get']) !!}

<div class="user_post">
  <div class="subcategory">
    <p class="subcategory_title">
    サブカテゴリー
  </p>
  <select
    id="category_id"
    name="category_id"
    class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
    value="{{ old('category_id') }}">
    @foreach($categories as $id => $name)
        <option value="{{ $id }}">{{ $name }}</option>
    @endforeach
  </select>
 {{-- @foreach($list as $list) --}}
  </div>
  <div class="title">
    <div class="title_title">
      <p class="post_title">
        タイトル
      </p>
        {!! Form::input('text','title_update',null,(['class'=>'title_form','placeholder'=>$list->title])) !!}
    </div>
  </div>
    </div>

    <div class="post_content">
    <div class="post_detail_contents">
      <p class="contents_title">
        投稿内容
      </p>
      {!! Form::input('text','post_update_form',null,(['class'=>'post_form','placeholder'=>$list->post])) !!}
    </div>
    <div class="update">
      {!! Form::hidden('posts_id',$list->id) !!}
      {!! Form::submit('更新') !!}
      {!! Form::close() !!}
    </div>

    <div class="delete">

    <a class="btn-delete" href="/delete/{{$list->id}}" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')">削除</a>
    </div>
  </div>

  {{-- @endforeach --}}
</div>

@endsection
