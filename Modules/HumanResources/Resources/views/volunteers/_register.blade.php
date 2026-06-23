
<div class="row">
    <div class="col-md-9 col-sm-7">
        <div class="form-row">
            <div class="col-md-4 mb-3 form-group">
                <label class="control-label" for="Last Name"> Name </label>
                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" name="first_name" placeholder="First Name" required >
                @if ($errors->has('first_name'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif       
            </div>
        
            <div class="col-md-4 mb-3 form-group">
                <label class="control-label text-white" for="first"> . </label>
                <input id="last_name" type="text" value="{{ old('last_name') }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="Last Name" required >
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        
            <div class="col-md-4 mb-3 form-group">
                    <label class="control-label text-white" for="middle_name"> . </label>
                    <input id="middle_name" type="text" value="{{ old('middle_name') }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" placeholder="Middle Name">
        
                @if ($errors->has('middle_name'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('middle_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 form-group mb-3">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="telephone">Telephone</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <select id="country_code" name="country_code" class="custom-select w-100 select2" data-live-search="true" title="Please select a country_code ...">
                        @foreach($telcodes as $key => $telcode)
                        @if ($telcode == 234)
                        <option value="{{$telcode}}" selected> {{$telcode}}</option>
                        @else
                        <option value="{{$telcode}}"> {{$telcode}}</option>
                        @endif
                        @endforeach
                        </select>
                    </div>
                    <input type="text" id="telephone" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{ old('telephone') }}" placeholder="Mobile Telephone Number" required>
                </div>
                @if ($errors->has('telephone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('telephone') }}</strong>
                        </span>
                    @endif
            </div>  
        </div>   
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password">{{ __('Password') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                    </div>
                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                </div>
        
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        
            <div class="col-md-6 mb-3">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                    </div>
                    <input id="password-confirm" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                </div>
        
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-5 mb-3">
        <div class="text-center">
            <img src="{{ asset('img/upload-passport.jpg')}}" class="avatar img-circle img-thumbnail" alt="Upload Passport Photo">

            <input type="file" name="passport_photo" class="form-control center-block file-upload {{ $errors->has('passport_photo') ? ' is-invalid' : '' }}" required>
        </div>
    </div>
</div>