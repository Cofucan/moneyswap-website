<div class="form-row">
    <div class="col-md-4 form-group mb-3">
            <label for="address_ref" class="control-label">Ref</label>
            <div class="input-group">
              <div class="input-group-append">
                  <select class="custom-select w-100 select2" id="address_prefix" name="address_prefix">
                      @foreach($addressPrefix as $address_prefix)
                              @if($outlet->Address->address_prefix == $address_prefix)
                                  <option value="{{  $address_prefix }}" selected>{{  $address_prefix }}</option>
                              @else
                                  <option value="{{  $address_prefix }}">{{  $address_prefix }}</option>
                              @endif
                          @endforeach
                  </select>
              </div>
              <input type="text" name="address_ref" value="{{ $outlet->Address->address_ref }}" class="form-control{{ $errors->has('address_ref') ? ' is-invalid' : '' }}" id="address_ref" placeholder="123/456" required>
            </div>
              @if ($errors->has('address_ref'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('address_ref') }}</strong>
                      </span>
              @endif

    </div>

    <div class="col-md-8 mb-3">

        <label for="street_name" class="control-label">Street</label>
        <input type="text" name="street_name" value="{{ $outlet->Address->street_name }}" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : '' }}" id="street_name" placeholder="">
        @if ($errors->has('street_name'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('street_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3 form-group">
            <label for="city_id"> State</label>
            <select name="state" class="custom-select d-block w-100 select2" id="state" required>
                <option>Choose City </option>
                @foreach($states as $key => $state)
                <option value="{{$key}}"> {{$state}}</option>
                @endforeach
            </select> 
            @if ($errors->has('city_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('city_id') }}</strong>
                        </span>
            @endif
    </div>

    <div class="col-md-4 mb-3 form-group">
        <label for="city_id"> City</label>
        <select name="city_id" class="custom-select d-block w-100 select2" id="city" required>
        </select>
        <span id="city_loading"><i class="fa fa-spinner fa-spin"></i></span>
    
        @if ($errors->has('city_id'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('city_id') }}</strong>
                    </span>
        @endif
    </div>

    <div class="col-md-4 mb-3 form-group">
        <label for="neighbourhood_id"> Neighbourhood</label>
        <select name="neighbourhood_id" class="custom-select d-block w-100 select2" id="neighbourhood" required>
        </select>
        <span id="city_loading"><i class="fa fa-spinner fa-spin"></i></span>
    </div>
</div>  