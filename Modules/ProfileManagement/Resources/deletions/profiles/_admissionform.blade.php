<div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="last_name" class="control-label"> Name</label>
            <div class="input-group">

              <input type="text" name="last_name" value="{{$admission->Profile->last_name }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" placeholder="Last Name"required>
            </div>
            @if ($errors->has('last_name'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
            @endif
        </div>

        <div class="col-md-4 mb-3">
          <label for="first_name" class="control-label">.</label>
          <input type="text" name="first_name" value="{{$admission->Profile->first_name }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="First Name">

            @if ($errors->has('first_name'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('first_name') }}</strong>
              </span>
            @endif
        </div>

        <div class="col-md-4 mb-3">
          <label for="middle_name" class="control-label">.</label>
          <input type="text" name="middle_name" value="{{$admission->Profile->middle_name}}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name" placeholder="Other Names">

            @if ($errors->has('middle_name'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('middle_name') }}</strong>
              </span>
            @endif
        </div>
      </div>

        <div class="form-row">

            <div class="col-md-6  form-group">
              <label class="control-label" for="birthday">Date of Birth</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                  <input type="text" name="birthday" value="01/01/2004" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"/>

              </div>
              @if ($errors->has('birthday'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('birthday') }}</strong>
                  </span>
              @endif
            </div>

          <div class="col-md-6 mb-3 form-group">
              <label for="gender" class="control-label"> Gender </label><br>
              <div class="custom-control custom-radio custom-control-inline">
                  <input id="male" name="gender" type="radio" value="Male" class="custom-control-input" required>
                  <label class="custom-control-label" for="male">Male</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                  <input id="Female" name="gender" type="radio" value="Female" class="custom-control-input" required>
                  <label class="custom-control-label" for="Female">Female</label>
              </div>
              @if ($errors->has('gender'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('gender') }}</strong>
                  </span>
              @endif
          </div>

        </div>

        <div class="form-row mb-4">
            <div class="col-md-6 mb-3 form-group">
                <label class="control-label" for="religion">Religion</label>
                <select name="religion" class="custom-select d-block w-100 select2" id="religion" required>
                    <option value="" > Select Religion </option>
                    <option value="Christianity">Christianity</option>
                    <option value="Islam">Islam</option>
                    <option value="Other">Other</option>
                </select>
                @if ($errors->has('religion'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('religion') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6 mb-3 form-group">
                <label class="control-label" for="primary_language">Primary language</label>
                <input id="primary_language" type="text" value="{{ $admission->Profile->primary_language}}" class="form-control{{ $errors->has('primary_language') ? ' is-invalid' : '' }}" name="primary_language" >
                @if ($errors->has('primary_language'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('primary_language') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-danger reveal pull-right"><b>Add More Details</b></button>
                <div class="toggle_container" id="Description">



                    <div class="form-row">
                        <div class="col-md-6 mb-3 form-group">
                            <label class="control-label" for="birthplace">Place of birth</label>
                            <input id="birthplace" type="text" value="{{ $admission->Profile->birthplace}}" class="form-control{{ $errors->has('birthplace') ? ' is-invalid' : '' }}" name="birthplace" >
                            @if ($errors->has('birthplace'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birthplace') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6  form-group">
                            <label class="control-label" for="birth_sequence">Position in Agent</label>
                            <input type="number" name="birth_sequence" value="{{ $admission->Profile->birth_sequence}}" class="form-control{{ $errors->has('birth_sequence') ? ' is-invalid' : '' }}"/>
                            @if ($errors->has('birth_sequence'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birth_sequence') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-6 mb-3 form-group">
                            <label for="country_code"> Nationality</label>
                            <select name="country_code" class="custom-select d-block w-100 select2 {{ $errors->has('country_code') ? ' is-invalid' : '' }}" id="country" >
                                {{-- <option>Choose Nationality </option> --}}
                                @foreach($countries as $key => $country)
                                <option value="{{$key}}"> {{$country}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country_code'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('country_code') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                            <label for="state_id"> State of Origin</label>
                            <select name="state_of_origin_id" class="custom-select d-block w-100 select2 {{ $errors->has('state_id') ? ' is-invalid' : '' }}" id="state">

                            </select>
                            <span id="state_loading"><i class="fa fa-spinner fa-spin"></i></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="bio">About</label>
                        <textarea name="bio" class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" id="bio" placeholder="realty description"> </textarea>
                        @if ($errors->has('bio'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('bio') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>

