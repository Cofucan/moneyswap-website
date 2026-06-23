<div class="modal fade" id="editgroup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center">Edit {{ $cohort->label}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cohorts.update', $cohort) }}" method="POST"  id="UpdateExpense">
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
