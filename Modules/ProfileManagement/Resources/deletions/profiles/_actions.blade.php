<div class="row no-gutters">
    <div class="col-md-6 col-6">
        <a class="btn btn-secondary btn-sm show" href="{{ route('profiles.show', $profile) }}">Details</a>
        <a data-toggle="modal" class="btn btn-primary btn-sm" data-target="#person-info{{$profile->id}}" href="#person-info{{$profile->id}}">
        <i class="fa fa-edit"> Edit</i></a>
    </div>
    <div class="col-md-6 col-6">
        @if($profile->status == 'Active')
        <a class="btn btn-warning btn-sm" href="{{ url('profiles/toggle', $profile)}}">Deactivate</a>
        @else
        <a class="btn btn-success btn-sm" href="{{ url('profiles/toggle', $profile)}}">Activate</a>
        @endif
    </div>
</div>
{{-- profile modal begins--}}
    <div class="modal fade" id="profile-info{{$profile->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('profiles.update', $profile) }}" id="UpdateProfile">
                        {{csrf_field()}}
                        @method('PUT')
                        @include('profilemanagement::profiles._formedit')
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
{{-- modal ends--}}

{{-- profile modal begins--}}
<div class="modal fade" id="person-info{{$profile->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-center">Update Bio Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('profiles.update', $profile) }}" id="UpdatePerson">
            {{csrf_field()}}
            @method('PUT')
                @include('profilemanagement::profiles._profileform')
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
{{-- modal ends--}}
