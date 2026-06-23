<div class="form-group has-feedback">
    <label for="postal_code">Postal Code &nbsp;
      <span class="requiredfield">*</span>
    </label>
    <input type="text" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" id="postal_code" name="postal_code" placeholder="Enter Postal Code" value="{{$neighbourhood->postal_code }}"  >
      @if ($errors->has('postal_code'))
        <span class="invalid-feedback">
        {{ $errors->first('postal_code') }}
        </span>
      @endif
  </div>
  {{-- <div class="form-row">
    <div class="col-md-6 mb-3 form-group">
            <label for="state_id"> State</label>
            <select name="state_id" class="custom-select d-block w-100 select2 {{ $errors->has('state_id') ? ' is-invalid' : '' }}" id="state" required>
                <option>Choose State </option>
                @foreach($states as $key => $state)
                <option value="{{$key}}"> {{$state}}</option>
                @endforeach
            </select>
            @if ($errors->has('state_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('state_id') }}</strong>
                        </span>
            @endif
    </div>

    <div class="col-md-6 mb-3 form-group">
            <label for="city_id"> State of Origin</label>
            <select name="city_id" class="custom-select d-block w-100 select2 {{ $errors->has('city_id') ? ' is-invalid' : '' }}" id="city" required>

            </select>
        <span id="city_loading"><i class="fa fa-spinner fa-spin"></i></span>
    </div>
</div> --}}
    
    <div class="form-group mb-5">
        <label for="neighbourhood_name">Neighbourhood Name <span class="text-muted">*</span></label>
        <input type="text" name="neighbourhood_name" value="{{$neighbourhood->neighbourhood_name }}" class="form-control{{ $errors->has('neighbourhood_name') ? ' is-invalid' : '' }}" id="neighbourhood_name" placeholder="Ajah">
        @if ($errors->has('neighbourhood_name'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('neighbourhood_name') }}</strong>
            </span>
            @endif
    </div>       

    <div class="form-row mt-5">
            <div class="col-md-12">
                <button class="btn btn-sm btn-danger reveal pull-right"><b>Add More Info</b></button>
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
                        <label for="about_neighbourhood">About</label>
                        <textarea name="about_neighbourhood" class="form-control{{ $errors->has('about_neighbourhood') ? ' is-invalid' : '' }}" id="about_neighbourhood" placeholder="state description"> </textarea>
                        @if ($errors->has('about_neighbourhood'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('about_neighbourhood') }}</strong>
                            </span>
                        @endif
                    </div>            
                </div>
    
            </div>
        </div>
    
  
    