@extends('layouts.top')
<link rel="stylesheet" href="css/create_category.css">
@section('content')

<a class="back" href="/top">もどる</a>

<a class="title" href="create_category">カテゴリー追加画面</a>

{!!Form::open(['url'=>'/create_category'])!!}
<div class="create_main_category">
  <p class="category_title">
    新規メインカテゴリー
  </p>
  <input class="main_form" type="text" name="main_category">
</div>
{{ Form::submit('登録') }}

<div class="sub_cate">
    <p class="category">メインカテゴリー</p>
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

<div class="create_sub_category">
  <p class="sub_category_title">
    新規サブカテゴリー
  </p>
  <input class="sub_form" type="text" name="sub_category">
</div>
{{ Form::submit('登録',['class'=>"sub_category_submit"]) }}
{!! Form::close() !!}

<div class="sub_windows">
  <p class="categories">
    カテゴリー一覧
  </p>
</div>
@endsection
