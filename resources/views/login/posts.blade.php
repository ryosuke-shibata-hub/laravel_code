@extends('layouts.top')

<link rel="stylesheet" href="css/posts.css">

@section('content')
<html>
  <div class="title">
    <h2>新規投稿画面</h2>
    <a class="back" href="/top">もどる</a>
  </div>

{!!Form::open(['url' => '/posts'])!!}
  <div class="sub_cate">
    <p class="category">サブカテゴリー</p>
    <select
    id="category_id"
    name="category_id"
    class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
    value="{{ old('category_id') }}"
>
    @foreach($categories as $id => $name)
        <option value="{{ $id }}">{{ $name }}</option>
    @endforeach
</select>
  </div>
  <div class="title">
    <p class="posts_title">タイトル</p>
      <input class="title_form" type="text" name="title">
  </div>
  <div class="post_contents">
    <p class="contents">投稿内容</p>
      <input class="posts_form" type="text" name="contents">
  </div>
    {{ Form::submit('投稿')}}

    {!!Form::close()!!}
</html>
@endsection
