<div class="row no-gutters">

    <div class="col-md-4">
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{$cohort->id}}">
            <i class="fa fa-edit"></i>
        </button>
        {{-- modal begins--}}
            <div class="modal fade bd-example-modal-lg{{$cohort->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-center">Edit {{$cohort->label}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" action="{{ route('cohorts.update', $cohort->id) }}" id="UpdateGroup" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @method('PUT')
                                @include('ClientManagement::cohorts._formedit')

                                <div class="modal-footer">
                                <button class="btn btn-success" type="submit">Save </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        {{-- modal ends--}}
    </div>
    <div class="col-md-3">
        <form action="{{ route('cohorts.destroy',$cohort->id) }}" method="post"
            onsubmit="return confirm('Are you sure you want to delete this record?');">
            <input type="hidden" name="_method" value="DELETE" />
            {{ csrf_field() }}
            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
        </form>
    </div>
</div>
