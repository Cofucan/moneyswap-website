{{-- modal begins--}}
<div class="modal fade" id="nextofkin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-center">Add Next of Kin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('nextofkins.store') }}" method="POST" id="CreateNextOfKin">
              {{csrf_field()}}
              <input type="hidden" name="member_id" value="{{ Auth::user()->Person->Member->id }}" class="form-control" />
      
                @include('nextofkins._form')

                <div class="modal-footer">
                  <button class="btn btn-success" type="submit">Save </button>
                </div>
              </form>
          </div>
      </div>
  </div>
</div>
{{-- modal ends--}}