
<div class="row">
    <div class="col-md-10 col-sm-8">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="last_name"> Full Name </label>
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

            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="middle_name"> . </label>
                    <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" placeholder="Middle Name">

                    @if ($errors->has('middle_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('middle_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="birthday">Date of Birth</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="date" name="birthday" value="01/21/2004" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" min="01/01/2004"  max="{{ date('Y-m-d') }}"/>

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
        </div>


        {{-- <div class="form-row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="primary_language">Primary language</label>
                    <input id="primary_language" type="text" value="{{ old ('primary_language')}}" class="form-control{{ $errors->has('primary_language') ? ' is-invalid' : '' }}" name="primary_language" >
                    @if ($errors->has('primary_language'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('primary_language') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="birth_sequence">Position in Agent</label>
                    <input type="number" name="birth_sequence" value="{{ old ('birth_sequence')}}" class="form-control{{ $errors->has('birth_sequence') ? ' is-invalid' : '' }}"/>
                    @if ($errors->has('birth_sequence'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('birth_sequence') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
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

            <div class="col-md-6">
                <div class="form-group">
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
            </div>
        </div> --}}
    </div>
    <div class="col-md-2 col-sm-4 mb-3">
        <div class="text-center">
            <img src="{{ asset('img/upload-passport.jpg')}}" class="avatar img-circle img-thumbnail" alt="Upload Client Photo">

            <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}">
        </div>
    </div>
</div>
