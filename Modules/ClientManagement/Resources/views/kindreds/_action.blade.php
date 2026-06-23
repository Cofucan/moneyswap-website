<div class="col-md-3">
<a class="btn btn-secondary btn-sm px-2" href="{{ route('clients.show', $client) }}">Details</a>
</div>

@if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16 )

    @if($client->enabled == true)
    <div class="col-md-2">
        <a class="btn btn-primary px-2 btn-sm" href="{{ route('clients.edit',$client)}}">Edit </a>
    </div>
    <div class="col-md-7">
    <form action="{{ route('clients.deactivation') }}" method="post"
        onsubmit='return confirm("When you deactivate the client's profile, {{ $client->name }} - {{ $client->admission_no }}, all outstanding revenue will be written-off?");'>
        {{ csrf_field() }}
        <input type="hidden" name="orphan_id" value="{{ $client->id}}" />
        <button type="submit" name="status" class="btn btn-sm btn-warning action_btn" value="Discontinued"> Deactivate </button>
        <button type="submit" name="status" class="btn btn-sm btn-danger action_btn" value="Expelled"> Expel </button>
    </form>
    </div>
    @endif
    @if($client->status == 'Discontinued')
    <div class="col-md-2">
        @include('clientmanagement::clients._activate')
    </div>
    @endif
@endif

