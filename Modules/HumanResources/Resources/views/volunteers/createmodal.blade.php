<div class="modal fade" id="investnow" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Invest in GMC-CFI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">                
                <form method="POST" action="{{ route('investments.store') }}" id="CreateInvestment">
                    {{csrf_field()}}                  
                    <input type="hidden" id="member_id" name="member_id" value="{{ Auth::user()->Person->member->id}}" >
                    @include('investments._form') 

                    
                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button class="btn btn-success btn-sm btn-block" type="submit">Invest </button>
                        </div> 
                    </div>
                </form>  
            </div>
            
        </div>
    </div>
</div>