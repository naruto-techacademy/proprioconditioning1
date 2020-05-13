<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Proprio Conditioning</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    </head>

    <body>

        @include('commons.navbar')
        
        <div class="container">
            @include('commons.error_messages')
            

    <form method="POST" action="{{ route('contact.confirm') }}">
    @csrf
        
    <div class="container">
            <h1 class="mt-4 pb-4 border-bottom">お問い合わせ</h1>
    
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">氏名：</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" name="name" required>
            </div>
        </div>
                      
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">メールアドレス：</label>
            <div class="col-sm-8">
            <input
            name="email"
            value="{{ old('email') }}"
            type="text"
            class="form-control">
            @if ($errors->has('email'))
                <p class="error-message">{{ $errors->first('email') }}</p>
            @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-table">タイトル：</label>
            <div class="col-sm-8">
            <input
            name="title"
            value="{{ old('title') }}"
            type="text"
            class="form-control">
            @if ($errors->has('title'))
                <p class="error-message">{{ $errors->first('title') }}</p>
            @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4 col-form-table">お問い合わせ内容：</label>
            <div class="col-sm-8">
            <textarea class="form-control" name="body">{{ old('body') }}</textarea>
            @if ($errors->has('body'))
                <p class="error-message">{{ $errors->first('body') }}</p>
            @endif
            </div>
        </div>
        
        
        
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button class="btn btn-success btn-block" type="submit" class="">お問い合わせ内容を送信する</button>
            </div>
        </div>
    </div>
    </form>

        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
 