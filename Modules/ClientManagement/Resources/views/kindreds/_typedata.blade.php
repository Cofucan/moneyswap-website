<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$client->admission_no}}</td>
    <td>{{$client->name }}</td>
    <td>{{ $client->class}} </td>
    <td>{{$client->gender }}</td>
    <td>{{ $client->age }} </td>
    <td>
        <div class="row">
            @include('ClientManagement::clients._action')
        </div>
    </td>
</tr>
@include('ClientManagement::clients._processmodal')
@include('ClientManagement::clients._editmodal')
