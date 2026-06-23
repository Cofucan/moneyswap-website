<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$kindred->profile->name }}</td>
    <td>{{$kindred->relationship->label}}</td>
    <td>{{ $kindred->occupation }} </td>
    <td>{{ $kindred->status}} </td>
    <td>
    <a class="btn btn-secondary btn-sm" href="{{ route('kindreds.show', $kindred) }}">Details</a>
    </td>
</tr>
