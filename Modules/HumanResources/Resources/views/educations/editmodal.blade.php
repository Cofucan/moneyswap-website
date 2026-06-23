<div class="modal fade" id="qualification{{$education->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-center">Update Education</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <p><b> Institute : </b> {{ $education->Organization->organization_name }} </p>
            <form method="POST" action="{{ route('educations.update', $education->id) }}" id="UpdateEducation">
                {{csrf_field()}}
                @method('PUT')
                {{-- <input type="hidden" class="form-control" value="{{$education->profile_id}}" name="profile_id"> --}}
                @include('educations._formedit')
            <div class="modal-footer">
                <button class="btn btn-success" type="submit"> Update </button>

            </div>
        </form>
        </div>
    </div>
    </div>
</div>