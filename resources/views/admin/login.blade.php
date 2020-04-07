@extends('layouts.app_admin')

@section('content')
    <div class="text-center">
        <h1>管理者ログイン</h1>
    </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <form method="POST" action="{{ route('admin.login') }}">
                        {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail Address</label>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                        <div class="col-md-6">
                                <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                        </div>
                        
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                    Login
                            </button>
                    </div>
                </form>   
            </div>
        </div>
@endsection
