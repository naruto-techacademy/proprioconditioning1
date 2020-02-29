@if (count($users) > 0)
    <ul class="list-unstyled">
                <div>
                        <p>各選手の最新Acute:Chronic Ratio</p>
                </<div>
        <table border="1"width="100%" style="table-layout: auto;">
                    <tr align="center">
                        <th>選手名</th>
                        <th>Acute:Chronic Ratio</th>
                        <th>トレーニング日</th>
                    </tr>
        @foreach ($users as $user)
            <tr align="center">
                        <td>{{ $user->name }}</td>
                        <?php $latest_item = $user->session_items()->orderBy('session_date' , 'desc')->first(); ?>
                        <td>@if (empty($latest_item) || empty($latest_item->rpe(28))){
                            {{ 'データ不足により計算不可' }}
                            }
                            @else
                            {{ sprintf('%.2f',$latest_item->rpe(7)*4/$latest_item->rpe(28)) }}
                            @endif
                            </td>
                        <td>@if (empty($latest_item) || empty($latest_item->session_date)){
                             {{ 'データ不足により計算不可' }}
                            }
                            @else{{ $latest_item->session_date }}
                            @endif</td>
                        <td> {!! link_to_route('users.show', '個人データ詳細', ['id' => $user->id]) !!}</td>
        @endforeach
            </ul>
    {{ $users->links('pagination::bootstrap-4') }}
    
@endif