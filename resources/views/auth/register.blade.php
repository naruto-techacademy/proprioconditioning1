@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Sign up</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}　フルネームで登録ください。
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                 <div class="form-group">
                    {!! Form::label('team_id', 'Team Name') !!}　<br>チームで登録の方はチーム管理者にご確認ください。<br>個人で登録の方は空欄でOKです。
                    {!! Form::text('team_id', old('team_id'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}　ログイン時に使用します。
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}　半角英数6文字以上で設定してください。
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirmation') !!}　パスワードを再入力してください。
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection