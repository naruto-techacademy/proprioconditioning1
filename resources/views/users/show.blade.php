@extends('layouts.app')

@section('content')
    <div class="row">
         <div class="col-sm-12">
             @if (Auth::id() == $user->id)
             {!! Form::open(['route' => 'session_items.store']) !!}
                <div class="form-group">
                    <p>○トレーニング日時<input type="date" name="session_date" min="2019-01-01" max="2030-12-31"></p>
                    <p>○トレーニングカテゴリー<select name="session_category" size="1">
                     <option value="通常トレーニング">通常トレーニング</option>
                     <option value="公式試合">公式試合</option>
                     <option value="練習試合">練習試合</option>
                     <option value="リハビリテーション">リハビリテーション</option>
                     <option value="ウェイトトレーニング">ウェイトトレーニング</option>
                     <option value="自主トレ、アクティブレスト">自主トレ、アクティブレスト</option>
                     <option value="完全レスト、トレーニングなし">完全レスト、トレーニングなし</option>
                     </select></p>
                          
                     <p>○トレーニングのつらさ{!! Form::select('session_rpe', [0,1,2,3,4,5,6,7,8,9,10]) !!}<br>とても楽「１」、楽「２」、まあまあ「３」、少しつらい「４」、つらい「５」、とてもつらい「７」、
                     <br>最大につらい「１０」として選んでください。完全レストは「０」とします。</p>
                     <p>○トレーニング時間（分）<input type="number" name="session_minutes" value="120"　placeholder="multiple of 5" step="5" min="0" max="600">分<br>
                     5分単位で記入してください。1時間の場合には「60」、1時間40分の場合には「100」完全レストでは「0」となります。</p>
                        
                     <p>○備考 疾病傷害等の状況<br /><input type="textarea" name='remarks' style="width:400px;;height:50px" value="なし"</p>
                     <p><br>{!! Form::submit('登録', ['class' => 'btn btn-primary btn-block']) !!}</p>
                     <?php $latest_item = $user->session_items()->orderBy('session_date' , 'desc')->first(); ?>
                     @if (empty($latest_item) || empty($latest_item->rpe(28))){
                            {{ 'データを入力しよう' }}
                            }
                     @elseif ($latest_item->rpe(7)*4/$latest_item->rpe(28) >2.0)
                     <span style="font-size:20px;color:#FF0000;">A:C Ratioが2.0を超えているので、トレーニング量と強度を調整して、怪我の発生を予防しよう！</span>
                     @else
                     <span style="font-size:20px;color:#FF0000;">この調子でA:C Ratioが2.0を超えないようにトレーニングを継続していきましょう。</span>
                     @endif
                </div>
                    {!! Form::close() !!}
                @endif
            
            @if (count($session_items) > 0)
                @include('session_items.session_items', ['session_items' => $session_items])
                {{ $session_items->links('pagination::bootstrap-4') }}
            @endif
            <a href="{{ route('export.session_items') }}" class="btn btn-primary font-weight-bold"><i class="fas fa-download"></i> Export to CSV</a>
        </div>
    </div>
    
@endsection