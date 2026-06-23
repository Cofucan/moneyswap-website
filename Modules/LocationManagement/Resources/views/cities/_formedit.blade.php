    
    <div class="form-row">
            <div class="col-md-6 form-group">
                <label for="state_id">Country code</label>
                <select class="custom-select d-block w-100 select2{{ $errors->has('state_id') ? ' is-invalid' : '' }}" name="state_id">
                    @foreach($states as $key => $state)
                        @if($city->state_id == $key)
                        <option value="{{ $key}}" selected> {{$state}}</option>
                        @else
                        <option value="{{ $key}}"> {{$state}}</option>
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('state_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('state_id') }}</strong>
                        </span>
                @endif
            </div>
    
            <div class="form-group">
                <label for="city_code"> City Code</label>
                <input type="text" name="city_code" value="{{$city->city_code}}" class="form-control" placeholder="e.g LG"  id="city_code" />
                @if ($errors->has('city_code'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('city_code') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group mb-5">
            <label for="city_name"> City Name </label>
            <input type="text" name="city_name" value="{{$city->city_name}}" class="form-control" placeholder="e.g Lagos"  id="city_name" />
            @if ($errors->has('city_name'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('city_name') }}</strong>
                </span>
            @endif
        </div>       
    
        <div class="form-row mt-5">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-danger reveal pull-right"><b>Add More Details</b></button>
                    <div class="toggle_container" id="Description">
                        
    
                        <div class="form-row">
                  
                            <div class="col-md-4 form-group">
                                <label for="population_estimate"> Population Estimate </label>
                                <input type="text" name="population_estimate" value="" class="form-control"  id="population_estimate" />
                                @if ($errors->has('population_estimate'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('population_estimate') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="latitude">Latitude </label>
                                <input type="text" name="latitude" value="" class="form-control"  id="latitude" />
                                @if ($errors->has('latitude'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                    
                            <div class="col-md-4 form-group">
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
                            <label for="about_city">About</label>
                            <textarea name="about_city" class="form-control{{ $errors->has('about_city') ? ' is-invalid' : '' }}" id="about_city" placeholder="state description"> </textarea>
                            @if ($errors->has('about_city'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('about_city') }}</strong>
                                </span>
                            @endif
                        </div>            
                    </div>
        
                </div>
            </div>
        
      
        