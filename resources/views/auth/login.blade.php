@extends('layouts.logout')

<link rel="stylesheet" href="css/login.css">

<body>


@section('content')

 <p>ログイン</p>





  {!! Form::open() !!}

    {{ Form::label('メールアドレス') }}
     @if ($errors->has('email'))
        <div>
            <ul style="list-style: none;">
                @foreach ($errors->get('email') as $error)
                    <li style="color: red; font-size: 14px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::text('email',null,['class'=>'input']) }}

    {{ Form::label('パスワード') }}
    @if ($errors->has('password'))
        <div>
            <ul style="list-style: none;">
                @foreach ($errors->get('password') as $error)
                    <li style="color: red; font-size: 14px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::password('password',null,['class'=>'input']) }}

    {{ Form::submit('ログイン')}}

  {!! Form::close() !!}

  <p class="create_user">新規ユーザー登録は
  <a href="register">こちら</a>

    </div>
  </p>


@endsection
</body>
