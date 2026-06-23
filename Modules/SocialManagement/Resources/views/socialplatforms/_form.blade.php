<div class="row">    
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label for="state_id" > State (required)&nbsp;
                <span class="requiredfield">*</span>
              </label>
                <select class="form-control{{ $errors->has('state_id') ? ' is-invalid' : '' }} select2"  data-placeholder="Select State" name="state_id" id="state_id" required="true" >
                  
                    
                </select>
                @if ($errors->has('state_id'))
                  <span class="invalid-feedback fa fa-map form-control-feedback right">
                  {{ $errors->first('state_id') }}
                  </span>
                @endif
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label for="city_code">City Code (3 characters required)&nbsp;
                <span class="requiredfield">*</span>
              </label>
              <input type="text" class="form-control{{ $errors->has('city_code') ? ' is-invalid' : '' }}" id="city_code" name="city_code" placeholder="Enter City Code" value="{{old('city_code') }}"  required="true" >
                @if ($errors->has('city_code'))
                  <span class="invalid-feedback">
                  {{ $errors->first('city_code') }}
                  </span>
                @endif
            </div>
      </div>        
      
      <div class="row">
            <div class=" col-xs-12 col-sm-12 col-md-12 form-group has-feedback">
              <label for="city_name">City Name (required)&nbsp;
                <span class="requiredfield">*</span>
              </label>
              <input value="{{old('city_name') }}" type="text" class="form-control{{ $errors->has('city_name') ? ' is-invalid' : '' }}" id="city_name" name="city_name" placeholder="City Name"  required="true">                      
                @if ($errors->has('city_name'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('city_name') }}</strong>
                  </span>
                @endif
            </div>
      </div>        
      
      <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label for="latitude">Latitude

              </label>
              <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude">
              @if ($errors->has('latitude'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('latitude') }}</strong>
                  </span>
                @endif
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label for="longitude">Longitude

              </label>
                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude">
                @if ($errors->has('longitude'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('longitude') }}</strong>
                  </span>
                @endif
            </div>
      </div>
      
      <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 form-group has-feedback">
              <label for="about_city">About City

              </label>
              <textarea name="about_city" class="form-control" placeholder="City Overview" id="about_city"></textarea>
              @if ($errors->has('about_city'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('about_city') }}</strong>
                  </span>
                @endif
              </div>       
      </div>      