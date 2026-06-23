

<div class="row">
    <div class="col-md-2 mb-3">
      <div class="form-group">
        <label for="address_no" class="control-label">Ref</label>         
        <select class="custom-select select2" id="address_prefix" name="address_prefix">
          @foreach($addressPrefix as $address_prefix)
            @if($profaddress->Address->address_prefix == $address_prefix)
              <option value="{{  $address_prefix }}" selected>{{  $address_prefix }}</option>
            @else
              <option value="{{  $address_prefix }}">{{  $address_prefix }}</option>
            @endif
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-2 mb-3">
      
        <label for="address_no" class="control-label">.</label>
        <input type="text" name="address_no" value="{{$profaddress->address->address_no }}" class="form-control{{ $errors->has('address_no') ? ' is-invalid' : '' }}" id="address_no" placeholder="123/456" >
        @if ($errors->has('address_no'))
          <span class="invalid-feedback">
            <strong>{{ $errors->first('address_no') }}</strong>
          </span>
        @endif
     
    </div>
    <div class="col-md-8 mb-3">
      <div class="form-group">
        <label for="street_name" class="control-label">Street Name</label>
        <input type="text" name="street_name" value="{{ $profaddress->address->street_name }}" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : '' }}" id="street_name" placeholder="e.g. John Adamu Ola Avenue" >
        @if ($errors->has('street_name'))
          <span class="invalid-feedback">
            <strong>{{ $errors->first('street_name') }}</strong>
          </span>
        @endif
      </div>
    </div>
  </div>

  <div class="form-group">
    <strong>Area</strong>: {{$profaddress->Address->area}}  
</div>


