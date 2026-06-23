<div class="modal fade" id="employment{{$employment->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Update Work Experience</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b> Organization : </b> {{ $employment->Organization->organization_name }} </p>
                <form method="POST" action="{{ route('employments.update', $employment->id) }}" id="UpdateEmployment">
                    {{csrf_field()}}
                    @method('PUT')
                    <input type="hidden" class="form-control" value="{{$employment->profile_id}}" name="profile_id">
                    @include('humanresources::employments._formedit')
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit"> Update </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
