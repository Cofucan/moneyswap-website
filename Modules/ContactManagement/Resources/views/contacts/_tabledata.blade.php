<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$contact->full_name}}</td>
    <td>{{$contact->email}}</td>
    <td>{{$contact->telephone}}</td>
    <td>
        <div class="row no-gutters">
            <div class="col-md-8">
                <a class="btn btn-primary btn-sm" data-toggle="modal" href="#edit{{$contact->id}}" data-target="#edit{{ $contact->id}}">Edit</a>
            </div>
            <div class="col-md-3">
                <form action="{{ route('contacts.destroy',$contact->id) }}" method="post"
                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                    <input type="hidden" name="_method" value="DELETE" />
                    {{ csrf_field() }}
                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
</tr>
@include('contactmanagement::contacts._modaledit')