<div class="col-md-3">
<a class="btn btn-secondary btn-sm px-3" href="{{ route('agents.show', $agent) }}">Details</a>
</div>

@if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16 )
    @if($agent->enabled == true)
    <div class="col-md-5">
        {{-- <a class="btn btn-primary px-3 btn-sm" href="{{ route('agents.edit',$agent)}}">Edit </a> --}}
        <a class="btn btn-warning btn-sm" href="{{ url('agents/toggle', $agent)}}">Deactivate</a>

    </div>
    <div class="col-md-2">
        <form action="{{ route('agents.destroy',$agent) }}" method="post"
            onsubmit="return confirm('Deleting this agent will delete all associated clients too! Click Ok to continue');">
            <input type="hidden" name="_method" value="DELETE" />
            {{ csrf_field() }}
            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
        </form>
    </div>
    @else
    <div class="col-md-3">
        <a class="btn btn-success btn-sm" href="{{ url('agents/toggle', $agent)}}">Activate</a>
    </div>
    @endif
@endif

