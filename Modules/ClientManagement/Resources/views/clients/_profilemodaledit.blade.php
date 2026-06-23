<a class="btn btn-secondary px-3  btn-sm" data-toggle="modal" data-target="#profile">
    Edit Personal Details
</a> 
{{-- profile modal begins--}}
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profiles.update',  $client->profile) }}" id="UpdateProfile">
                    {{csrf_field()}}
                    @method('PUT')

                    @include('profilemanagement::profiles._studentform')

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
{{-- modal ends--}}