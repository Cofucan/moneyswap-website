
    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target=".bd-example-modal-lg">
        <i class="fa fa-plus"></i> Add Client Group
    </button>

<div class="col-md-2">
    {{-- modal begins--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title text-center">New Clients Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('cohorts.store') }}" id="CreateCohort" enctype="multipart/form-data">
                    {{csrf_field()}}
                        @include('ClientManagement::cohorts._form')

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
