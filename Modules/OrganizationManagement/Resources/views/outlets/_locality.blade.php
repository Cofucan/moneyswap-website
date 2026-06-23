<div class="row">
  <div class="col-md-4"> 
    <div class="form-group">
            <label for="city_id"> State</label>
            <select name="state_id" class="custom-select d-block w-100 select2" id="state" required>
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
    </div>            
    <div class="col-md-4"> 
      <div class="form-group">
      <label for="city_id"> City</label><span id="city_loading"><i class="fa fa-spinner fa-spin"></i></span>
      <select name="city_id" class="custom-select d-block w-100 select2" id="city" required>
          <option>Choose City </option>
      </select>
      @if ($errors->has('city_id'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('city_id') }}</strong>
        </span>
      @endif
      </div>
    </div>            
    <div class="col-md-4"> 
      <div class="form-group">
          <label for="neighbourhood_name"> Neighbourhood</label>
          <input type="text" name="neighbourhood_name" value="{{old('neighbourhood_name')}}" class="form-control{{ $errors->has('neighbourhood_name') ? ' is-invalid' : '' }}"/>
          @if ($errors->has('neighbourhood_name'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('neighbourhood_name') }}</strong>
            </span>
          @endif
        </div>
    </div>
  </div>