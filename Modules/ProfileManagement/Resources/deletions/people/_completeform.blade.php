<div class="form-row">
    <div class="col-md-4 mb-3">
        <label for="last_name" class="control-label"> Name</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <select id="salutation" name="salutation" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a salutation ...">
                <option value="Mr" selected> Mr </option>
                <option value="Mrs"> Mrs </option>
                <option value="Miss">Miss </option>
            </select>
          </div>
          <input type="text" name="last_name" value="{{old('last_name') }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" placeholder="Last Name"required>    
        </div>                               
        @if ($errors->has('last_name'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('last_name') }}</strong>
                </span>
        @endif    
    </div>

    <div class="col-md-4 mb-3">
      <label for="first_name" class="control-label">.</label>
      <input type="text" name="first_name" value="{{old('first_name') }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="First Name">
      
        @if ($errors->has('first_name'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('first_name') }}</strong>
          </span>
        @endif
    </div>

    <div class="col-md-4 mb-3">
      <label for="middle_name" class="control-label">.</label>
      <input type="text" name="middle_name" value="{{old('middle_name') }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name" placeholder="Other Names">
      
        @if ($errors->has('middle_name'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('middle_name') }}</strong>
          </span>
        @endif
    </div>
  </div>

    <div class="form-row">
      <div class="col-md-6 mb-3 form-group">
          <label class="control-label" for="marital_status">Marital Status</label><br>
          <div class="custom-control custom-radio custom-control-inline">
              <input id="single" name="marital_status" type="radio" value="single" class="custom-control-input" required>
              <label class="custom-control-label" for="single">Single</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
              <input id="married" name="marital_status" type="radio" value="married" class="custom-control-input" required>
              <label class="custom-control-label" for="married">Married</label>
          </div>
             
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
          <label class="control-label" for="birthplace">Place of birth</label>
          <input id="birthplace" type="text" value="{{ old ('birthplace')}}" class="form-control{{ $errors->has('birthplace') ? ' is-invalid' : '' }}" name="birthplace" >
          @if ($errors->has('birthplace'))
              <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('birthplace') }}</strong>
              </span>
          @endif
      </div>
  </div>

  <div class="form-row">
      

      <div class="col-md-6 mb-3 form-group">
          <label class="control-label" for="primary_language">Primary language</label>
          <input id="primary_language" type="text" value="{{ old ('primary_language')}}" class="form-control{{ $errors->has('primary_language') ? ' is-invalid' : '' }}" name="primary_language" >
          @if ($errors->has('primary_language'))
              <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('primary_language') }}</strong>
              </span>
          @endif
      </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3 form-group">
        <label for="country_code"> Nationality</label>
        <select name="country_code" class="custom-select d-block w-100 select2 {{ $errors->has('country_code') ? ' is-invalid' : '' }}" id="country" required>
            <option>Choose Nationality </option>
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
        <label class="control-label" for="birthplace">Place of birth</label>
        <input id="birthplace" type="text" value="{{ old ('birthplace')}}" class="form-control{{ $errors->has('birthplace') ? ' is-invalid' : '' }}" name="birthplace" >
        @if ($errors->has('birthplace'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('birthplace') }}</strong>
            </span>
        @endif
    </div>
  </div>

    <div class="form-row">
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