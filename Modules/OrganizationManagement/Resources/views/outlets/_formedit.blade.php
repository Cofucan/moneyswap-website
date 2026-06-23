
<div class="form-group">
  <strong>Area: </strong> {{$outlet->City->area}}
</div>

<div class="form-group">
  <label for="label" class="control-label">Outlet Name</label>       
  <input type="text" name="label" value="{{$outlet->label }}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" id="label" placeholder="" required>
  @if ($errors->has('label'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('label') }}</strong>
      </span>
  @endif        
</div>  

<div class="form-row">
  <div class="col-md-4 form-group mb-3">
      <label for="building_number" class="control-label">Building No.</label>                  
      <input type="text" name="building_number" value="{{$outlet->building_number }}" class="form-control{{ $errors->has('building_number') ? ' is-invalid' : '' }}" id="building_number" placeholder="123/456" required>
      @if ($errors->has('building_number'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('building_number') }}</strong>
          </span>
      @endif
  </div>

  <div class="col-md-8 mb-3">
  <label for="street_name" class="control-label">Street</label>
  <input type="text" name="street_name" value="{{$outlet->street_name }}" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : '' }}" id="street_name" placeholder="" required>
  @if ($errors->has('street_name'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('street_name') }}</strong>
      </span>
  @endif
  </div>
</div>

<div class="form-group">
  <label for="outlet_type" class="control-label">Outlet Type</label>       
  <select class="custom-select d-block w-100 select2 {{ $errors->has('outlet_type') ? ' is-invalid' : '' }}"  name="outlet_type" id="outlet_type">
      @foreach($outletTypes as $outletType)
          @if($outlet->outlet_type == $outletType)
              <option value="{{  $outletType }}" selected>{{  $outletType }}</option>
          @else
              <option value="{{  $outletType }}">{{  $outletType }}</option>
          @endif
      @endforeach
  </select>
  @if ($errors->has('outlet_type'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('outlet_type') }}</strong>
      </span>
  @endif  
</div>

<div class="form-group">
  <label for="telephone" class="control-label">Telephone</label>       
  <input type="text" name="telephone" value="{{$outlet->telephone }}" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" id="telephone" placeholder="Outlet Number">
  @if ($errors->has('telephone'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('telephone') }}</strong>
      </span>
  @endif  
</div>