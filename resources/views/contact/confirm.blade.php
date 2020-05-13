@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('contact.send') }}">
    @csrf
    <div class="form-group row">
        
    <label class="col-sm-4 col-form-label">氏名</label>
    {{ $inputs['name'] }}
    <div class="col-sm-8">
        <input
        name="name"
        value="{{ $inputs['name'] }}"
        type="hidden">
     </div>
    </div>
    
    <div class="form-group row">    
    <label class="col-sm-4 col-form-label">メールアドレス</label>
    {{ $inputs['email'] }}
    <div class="col-sm-8">
        <input
        name="email"
        value="{{ $inputs['email'] }}"
        type="hidden">
    </div>
    </div>
        
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">タイトル</label>
    {{ $inputs['title'] }}
    <div class="col-sm-8">
        <input
        name="title"
        value="{{ $inputs['title'] }}"
        type="hidden">
     </div>
    </div>
    
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">お問い合わせ内容</label>
    {!! nl2br(e($inputs['body'])) !!}
    <div class="col-sm-8">
        <input
        name="body"
        value="{{ $inputs['body'] }}"
        type="hidden">
    </div>
    </div>
    
    <button class="btn btn-warning btn-block" type="submit" name="action" value="back">
        入力内容修正
    </button>
    <button class="btn btn-success btn-block" type="submit" name="action" value="submit">
        送信する
    </button>
</form>
@endsection