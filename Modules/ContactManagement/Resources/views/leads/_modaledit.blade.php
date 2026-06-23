<div class="modal fade" id="edit{{ $lead->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">Upgrade Lead Sales Cycle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('leads.update', $lead) }}" method="POST"  id="UpdateContact">
                {{csrf_field()}}
                @method('PUT')
                
                <div class="form-group row mb-3">
                  <label for="email" class="control-label col-md-3">Sales Cycle</label>
                  <div class="col-md-8">
                    <select class="custom-select w-100 select2" id="sales_cycle_id" name="sales_cycle_id">                
                      @foreach($salescycles as $key => $cycle)
                        @if($lead->sales_cycle_id == $key)
                            <option value="{{  $key }}" selected>{{  $cycle }}</option>
                        @else
                            <option value="{{  $key }}">{{  $cycle }}</option>
                        @endif
                      @endforeach
                  </select>      
                  </div>
                </div> 
              <div class="modal-footer">                           
                  <button class="btn btn-primary px-4" type="submit" >Save</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>