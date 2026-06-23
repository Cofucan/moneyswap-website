<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$client->admission_no}}</td>
    <td>{{$client->name}}</td>
    <td>{{ $client->gender}} </td>
    <td>{{ $client->attendance_type}} </td>
    <td>
        <div class="row">
            @include('ClientManagement::clients._action')
        </div>
    </td>
</tr>
