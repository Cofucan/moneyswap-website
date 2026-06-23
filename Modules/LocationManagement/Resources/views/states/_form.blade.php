    
    <div class="form-row">
        <div class="col-md-6 form-group">
            <label for="country_code">Country code</label>
            <select class="custom-select d-block w-100 select2{{ $errors->has('country_code') ? ' is-invalid' : '' }}" name="country_code">
                @foreach($countries as $country)
                    @if(old('country_code') == $country)
                    <option value="{{ $country}}" selected> {{$country}}</option>
                    @else
                    <option value="{{ $country}}"> {{$country}}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('country_code'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('country_code') }}</strong>
                    </span>
            @endif
        </div>

        <div class="col-md-6 form-group">
            <label for="state_code"> State Code</label>
            <input type="text" name="state_code" value="{{old('state_code')}}" class="form-control" placeholder="e.g LG"  id="state_code" />
            @if ($errors->has('state_code'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('state_code') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group mb-4">
        <label for="state_name"> State Name </label>
        <input type="text" name="state_name" value="{{old('state_name')}}" class="form-control" placeholder="e.g Lagos"  id="state_name" />
        @if ($errors->has('state_name'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('state_name') }}</strong>
            </span>
        @endif
    </div>       

    <div class="form-row mt-4">
            <div class="col-md-12">
                <button class="btn btn-sm btn-danger reveal pull-right"><b>Add More Info</b></button>
                <div class="toggle_container" id="Description">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="state_symbol"> State Symbol </label>
                            <input type="file" name="state_symbol" value="" class="form-control" id="state_symbol" />
                            @if ($errors->has('state_symbol'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('state_symbol') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="population_estimate"> State Symbol </label>
                            <input type="text" name="population_estimate" value="" class="form-control"  id="population_estimate" />
                            @if ($errors->has('population_estimate'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('population_estimate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="latitude">Latitude </label>
                            <input type="text" name="latitude" value="" class="form-control"  id="latitude" />
                            @if ($errors->has('latitude'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('latitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    
                        <div class="col-md-6 form-group">
                            <label for="longitude"> Longitude </label>
                            <input type="text" name="latitude" value="" class="form-control"  id="latitude" />
                            @if ($errors->has('latitude'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('latitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                 

                                       
                    <div class="form-group mb-3">
                        <label for="about_state">About</label>
                        <textarea name="about_state" class="form-control{{ $errors->has('about_state') ? ' is-invalid' : '' }}" id="about_state" placeholder="state description"> </textarea>
                        @if ($errors->has('about_state'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('about_state') }}</strong>
                            </span>
                        @endif
                    </div>            
                </div>
    
            </div>
        </div>
    
  
    