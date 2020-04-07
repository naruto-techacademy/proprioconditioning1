@extends('layouts.app_admin')

@section('content')
    @include('admin.users', ['users' => $users])
@endsection