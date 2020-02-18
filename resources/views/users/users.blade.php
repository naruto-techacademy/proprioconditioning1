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
                        <td>{{ sprintf('%.2f',$latest_item->rpe(7)*4/$latest_item->rpe(28)) }}</td>
                        <td>{{ $latest_item->session_date }}</td>
                        <td> {!! link_to_route('users.show', '個人データ詳細', ['id' => $user->id]) !!}</td>
                        
            
        @endforeach
            </ul>
    {{ $users->links('pagination::bootstrap-4') }}
@endif