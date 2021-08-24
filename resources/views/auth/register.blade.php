@extends('layouts.logout')

<link rel="stylesheet" href="css/register.css">

<body>
  @section('content')

    <p>ユーザー登録</p>



    {!! Form::open() !!}

    {{ Form::label('ユーザー名') }}
    @if ($errors->has('username'))
        <div>
            <ul style="list-style: none;">
                @foreach ($errors->get('username') as $error)
                    <li style="color: red; font-size: 14px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::text('username',null,['class'=>'input'])}}

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

    {{ Form::label('パスワード確認') }}
    @if ($errors->has('password_confirmed'))
        <div>
            <ul style="list-style: none;">
                @foreach ($errors->get('password_confirmed') as $error)
                    <li style="color: red; font-size: 14px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::password('password_confirmed',null,['class'=>'input']) }}


    {{ Form::submit('確認')}}

    <a href="login">戻る</a>

  {!! Form::close() !!}




  @endsection
</body>
