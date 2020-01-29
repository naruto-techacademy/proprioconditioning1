@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                 <h1>Welcome to Proprio Conditioning</h1>
                <h3><br>日々のトレーニング強度とトレーニング時間を記録して、<br>最適なコンディショニングにつなげよう！</h3>
             {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection