<div class="form-row">
    <div class="col-md-4 form-group mb-3">
          <label for="address_no" class="control-label">Ref</label>
          <div class="input-group">
              <div class="input-group-append">
                  <select class="custom-select w-100 select2" id="address_prefix" name="address_prefix">
                      @foreach($addressPrefix as $address_prefix)
                              @if($address->address_prefix == $address_prefix)
                                  <option value="{{  $address_prefix }}" selected>{{  $address_prefix }}</option>
                              @else
                                  <option value="{{  $address_prefix }}">{{  $address_prefix }}</option>
                              @endif
                              <option value="{{  $address_prefix }}">{{  $address_prefix }}</option>
                          @endforeach
                  </select>
              </div>
              <input type="text" name="address_no" value="{{ $address->address_no }}" class="form-control{{ $errors->has('address_no') ? ' is-invalid' : '' }}" id="address_no" placeholder="123/456" required>
          </div>
              @if ($errors->has('address_no'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('address_no') }}</strong>
                      </span>
              @endif
      </div>

    <div class="col-md-8 mb-3">

          <label for="street_name" class="control-label">Street</label>
          <input type="text" name="street_name" value="{{ $address->street_name }}" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : '' }}" id="street_name" placeholder="">
                  @if ($errors->has('street_name'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('street_name') }}</strong>
                  </span>
                  @endif
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3 form-group">
            <label for="city_id"> City</label>
            <select name="city_id" class="custom-select d-block w-100 select2" id="city" required>
                <option>Choose City </option>
                @foreach($cities as $key => $city)
                <option value="{{$key}}"> {{$city}}</option>
                @endforeach
            </select>
            @if ($errors->has('city_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('city_id') }}</strong>
                        </span>
            @endif
    </div>

    <div class="col-md-6 mb-3 form-group">
            <label for="neighbourhood_id"> Neighbourhood</label>
            <select name="neighbourhood_id" class="custom-select d-block w-100 select2" id="neighbourhood" required>
            </select>
        <span id="city_loading"><i class="fa fa-spinner fa-2x fa-spin"></i></span>
    </div>
  </div>
