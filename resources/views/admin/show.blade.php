@extends('layouts.app_admin')

@section('content')
    <div class="row">
         <div class="col-sm-12">
             管理者ショーページ
             
            @if (count($session_items) > 0)
                @include('session_items.session_items', ['session_items' => $session_items])
                {{ $session_items->links('pagination::bootstrap-4') }}
            @endif
            
        </div>
    </div>
    
@endsection