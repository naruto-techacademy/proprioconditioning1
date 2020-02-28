<ul class="list-unstyled">
             <p>{{ $user->name }}のデータ詳細<br></p>
             <li class="media mb-3">
                <table border="1"width="100%" style="table-layout: auto;">
                    <tr align="center">
                        <th>トレーニング<br>日時</th>
                        <th>トレーニングの<br>つらさ</th>
                        <th>トレーニング<br>時間</th>
                        <th>トレーニング<br>カテゴリー</th>
                        <th>Session RPE</th>
                        <th>Acute RPE</th>
                        <th>Chronic RPE</th>
                        <th>A:C Ratio</th>
                        <th>備考</th>
                    </tr>
                    @foreach ($session_items as $session_item)
                    
                    <tr align="center">
                        <td>{{ $session_item->session_date }}</td>
                        <td>{{ $session_item->session_rpe }}</td>
                        <td>{{ $session_item->session_minutes }}</td>
                        <td>{{ $session_item->session_category}}</td>
                        <td>{{ $session_item->session_rpe*$session_item->session_minutes }}</td>
                        <td>{{ $session_item->rpe(7) }}</td>
                        <td>{{ $session_item->rpe(28) }}</td>
                        <td>@if(empty($session_item->rpe(28))){
                            {{ 'データ不足により計算不可' }}
                            }
                            @else
                            {{ sprintf('%.2f',$session_item->rpe(7)*4/$session_item->rpe(28)) }}
                            @endif</td>
                        <td>{{ $session_item->remarks }}</td>
                        <td>@if (Auth::id() == $session_item->user_id)
                        {!! Form::open(['route' => ['session_items.destroy', $session_item->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                     @endforeach
                </table>
            </div>
        </li>
   
</ul>
