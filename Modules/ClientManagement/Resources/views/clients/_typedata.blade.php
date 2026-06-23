<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$client->reference}}</td>
    <td>{{$client->name }}</td>
    <td>{{ $client->category_name}} </td>
    <td>{{$client->program_name }}</td>
    <td>{{ $client->status }} </td>
    <td>
        <div class="row">
            @include('clientmanagement::clients._action')
        </div>
    </td>
</tr>
@include('clientmanagement::clients._processmodal')
@include('clientmanagement::clients._editmodal')
