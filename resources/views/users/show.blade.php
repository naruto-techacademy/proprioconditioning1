@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                </div>
            </div>
            @include('user_follow.follow_button', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('users.navtabs', ['user' => $user])
            @if (Auth::id() == $user->id)
                {!! Form::open(['route' => 'session_items.store']) !!}
                    <div class="form-group">
                        <p>トレーニング日時<br />{!! Form::textarea('session_date', old('session_date'), ['class' => 'form-control', 'rows' => '1']) !!}</p>
                        <p>トレーニングカテゴリー<br />{!! Form::textarea('session_category', old('session_category'), ['class' => 'form-control', 'rows' => '1']) !!}</p>
                        <p>トレーニングのつらさ<br />{!! Form::textarea('session_pre', old('session_rpe'), ['class' => 'form-control', 'rows' => '1']) !!}</p>
                        <p>トレーニング時間<br />{!! Form::textarea('session_minutes', old('session_minutes'), ['class' => 'form-control', 'rows' => '1']) !!}</p>
                        <p>備考<br />{!! Form::textarea('remarks', old('remarks'), ['class' => 'form-control', 'rows' => '2']) !!}</p>
                        {!! Form::submit('登録', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            @endif
            @if (count($session_items) > 0)
                @include('session_items.session_items', ['session_items' => $session_items])
            @endif
        </div>
    </div>
@endsection