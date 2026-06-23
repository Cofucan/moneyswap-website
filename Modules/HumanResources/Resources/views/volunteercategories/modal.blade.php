<div class="modal fade" id="editplan{{ $investmentplan->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Update Investment Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">                
                <form action="{{ route('investmentplans.update', $investmentplan->id) }}" method="POST"  id="UpdateInvestmentPlan">
                    {{csrf_field()}}
                    @method('PUT')

                    @include('investmentplans._formedit') 

                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button class="btn btn-success btn-sm btn-block" type="submit">Update </button>
                        </div> 
                    </div>
                </form>  
            </div>
            
        </div>
    </div>
</div>