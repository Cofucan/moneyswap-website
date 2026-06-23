<div class="col-md-3">
<a class="btn btn-secondary btn-sm px-2" href="{{ route('clients.show', $client) }}">Details</a>
</div>

@if($client->enabled == false && Auth::id() == $client->user_id)
    <div class="col-md-2">
        <a class="btn btn-primary px-2 btn-sm" href="{{ route('clients.edit',$client)}}">Edit </a>
    </div>
    <div class="col-md-7">
        <form action="{{ route('clients.destroy',$client->id) }}" method="post"
            onsubmit="return confirm('Are you sure you want to delete this record?');">
            <input type="hidden" name="_method" value="DELETE" />
            {{ csrf_field() }}
            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
        </form>
    </div>
@else@if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16 )
@endif


