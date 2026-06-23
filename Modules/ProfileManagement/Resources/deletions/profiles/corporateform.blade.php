<div class="form-group mb-3">
    <label for="legal_name">School/Organization Name</label>
        <input id="legal_name" type="text" value="{{ old ('legal_name')}}" class="form-control{{ $errors->has('legal_name') ? ' is-invalid' : '' }}" name="legal_name" required>
        @if ($errors->has('legal_name'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('legal_name') }}</strong>
            </span>
        @endif
</div>
<div class="row">
    <div class="col-md-10 col-sm-8">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="salutation"> . </label>
                    <input id="salutation" type="text" class="form-control{{ $errors->has('salutation') ? ' is-invalid' : '' }}" name="salutation" placeholder="e.g Dr.">

                    @if ($errors->has('salutation'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('salutation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="last_name"> Contact Person </label>
                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="Last Name" required >
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="first_name"> . </label>
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="First Name" required >
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


        </div>
       <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="telephone" class="label-control">Telephone <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"> <i class="fa fa-phone"></i></div>
                </div>
                <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" placeholder="" value="{{ old('telephone') }}" required>
              </div>
              @if ($errors->has('telephone'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('telephone') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="email" class="label-control"> Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"> <i class="fa fa-envelope"></i></div>
                </div>
                <input id="email" type="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="">
              </div>

              @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
          </div>
        </div>


    </div>

</div>
