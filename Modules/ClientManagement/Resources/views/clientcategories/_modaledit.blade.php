<div class="modal fade" id="edit{{ $clientcategory->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-center">Edit {{ $clientcategory->label}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('clientcategories.update', $clientcategory) }}" method="POST"  id="UpdateExpense">
                  {{csrf_field()}}
                  @method('PUT')

                  <div class="form-group">
                    <label for="label"> Name <span class="required">*</span></label>
                    <input type="text" name="label" value="{{ $clientcategory->label }}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}"  id="label" required/>
                    @if ($errors->has('label'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                    <div class="form-group ">
                        <label for="overview">Overview</label>
                        <textarea name="overview" class="form-control">{!! $clientcategory->overview !!}</textarea>
                        @if ($errors->has('overview'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('overview') }}</strong>
                            </span>
                        @endif
                    </div>
                
                  <div class="modal-footer">
                      <button class="btn btn-success" type="submit">Save </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>