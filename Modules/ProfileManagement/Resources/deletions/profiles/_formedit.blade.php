<div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="last_name" class="control-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ $profile->last_name }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" required>
                    @if ($errors->has('last_name'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="first_name" class="control-label">First Name</label>
                    <input type="text" name="first_name" value="{{ $profile->first_name }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" required>

                    @if ($errors->has('first_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="middle_name" class="control-label">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ $profile->middle_name }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name">

                    @if ($errors->has('middle_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('middle_name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="gender" class="control-label"> Gender </label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="Male" name="gender" type="radio" value="Male" class="custom-control-input" {{ $profile->gender =='Male' ? 'checked' : ''}} required>
                            <label class="custom-control-label" for="Male">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="Female" name="gender" type="radio" value="Female" class="custom-control-input" {{ $profile->gender =='Female' ? 'checked' : ''}} required>
                            <label class="custom-control-label" for="Female">Female</label>
                        </div>
                        @if ($errors->has('gender'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="birthday">Date of Birth</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }} pull-right" name="birthday"  value="{{ $profile->birthday }}">
                            </div>

                            @if ($errors->has('birthday'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

              </div>
               <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="nationalities" class="control-label"> Nationality </label><br>
                            <select id="country_code" name="country_code" class="select2 w-100 form-control" title="Please select a cause ...">
                                <option value=""> Your Country </option>
                                @foreach($countries as $key => $country)
                                    @if(old('country_code') == $key)
                                        <option value="{{$key}}" selected>  {{ $country }} </option>
                                        @else
                                        <option value="{{$key}}">  {{ $country }} </option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('country_code'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('country_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if($profile->role_id == 10)
                        <label for="religion_id">Religion<span class="text-danger"></span></label>
                        <select name="religion" class="custom-select d-block w-100 select2 {{ $errors->has('religion_id') ? ' is-invalid' : '' }}" id="religion">
                            <option value=""> Select Religion Affiliation</option>
                            @foreach($religions as $key => $religion)
                            <option value="{{$key}}"> {{$religion}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('religion_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('religion_id') }}</strong>
                            </span>
                        @endif
                    @else
                        <label class="control-label" for="marital_status">Marital Status</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="single" name="marital_status" type="radio" value="single" class="custom-control-input" {{ $profile->marital_status == 'single' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="single">Single</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="married" name="marital_status" type="radio" value="married" class="custom-control-input" {{ $profile->marital_status == 'married' ? 'checked' : ''}} >
                            <label class="custom-control-label" for="married">Married</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="divorced" name="marital_status" type="radio" value="divorced" class="custom-control-input" {{ $profile->marital_status == 'divorced' ? 'checked' : ''}} >
                            <label class="custom-control-label" for="divorced">Divorced</label>
                                </div>
                        @if ($errors->has('marital_status'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('marital_status') }}</strong>
                            </span>
                        @endif

                    @endif
                    </div>
              </div>
            <h6 class="m-l-20">Contact Address</h6>
            @if (is_null($profile->address_id))
                @include('locationmanagement::addresses._form')
            @else
            <label class="control-label" for="contact_address">{{ $profile->contact_address }}</label>
            @endif

<div class="form-row mb-4">
    <div class="col-md-6 form-group">
      <label for="email" class="control-label">Email</label>

        <input type="email" name="email" value="{{$profile->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" >

        @if ($errors->has('email'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="col-md-6 form-group ">
      <label for="telephone" class="control-label">Telephone</label>
      <input type="tel" name="telephone" value="{{$profile->telephone}}" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" id="telephone" >


        @if ($errors->has('telephone'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('telephone') }}</strong>
        </span>
        @endif
    </div>
</div>

