 {{-- profile modal begins--}}
 <div class="modal fade" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-center">Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('addresses.update',  $member->Profile->address) }}" id="UpdateProfile">
              {{csrf_field()}}
              @method('PUT')
             
              <div class="form-row">
                <div class="col-md-4 mb-3 form-group">
                    <label class="control-label" for="Last Name"> Name </label>
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ $member->Profile->first_name }}" name="first_name" placeholder="First Name" required >
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif       
                </div>
            
                <div class="col-md-4 mb-3 form-group">
                    <label class="control-label text-white" for="first"> . </label>
                    <input id="last_name" type="text" value="{{ $member->Profile->last_name }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="Last Name" required >
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            
                <div class="col-md-4 mb-3 form-group">
                        <label class="control-label text-white" for="middle_name"> . </label>
                        <input id="middle_name" type="text" value="{{ $member->Profile->middle_name }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" placeholder="Middle Name">
            
                    @if ($errors->has('middle_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('middle_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="birthday">Date of Birth</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="date" name="birthday" value="{{$member->Profile->birthday}}" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"/>

                    </div>
                    @if ($errors->has('birthday'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('birthday') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="email">Email</label>
                   
                    <input type="email" name="email" value="{{$member->Profile->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"/>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
            </div>      

              <div class="modal-footer">
                  <button class="btn btn-success px-3" type="submit">Save </button>
              </div>
            </form>

        </div>
      </div>
    </div>
  </div>
{{-- profile modal ends--}}