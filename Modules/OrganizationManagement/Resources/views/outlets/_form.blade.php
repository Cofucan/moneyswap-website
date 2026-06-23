@if(isset($organization) && !empty($organization->id))
  <input type="hidden" name="organization_id" value="{{ $organization->id }}">
@elseif(isset($portal) && !empty($portal->organization_id))
  <input type="hidden" name="organization_id" value="{{ $portal->organization_id }}">
@elseif(old('organization_id', request('organization_id')))
  <input type="hidden" name="organization_id" value="{{ old('organization_id', request('organization_id')) }}">
@endif

<div class="form-group">
  <label for="label" class="control-label">Outlet Name</label>       
  <input type="text" name="label" value="{{old ('label') }}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" id="label" placeholder="" required>
  @if ($errors->has('label'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('label') }}</strong>
      </span>
  @endif        
</div>   

<div class="form-row">
  <div class="col-md-7 form-group">
      <label for="outlet_type" class="control-label">Outlet Type</label>
      <select class="custom-select d-block w-100 select2 {{ $errors->has('outlet_type') ? ' is-invalid' : '' }}"  name="outlet_type" id="outlet_type">
          @foreach($outletTypes as $key => $outletType)
              @if(old('outlet_type') == $key || old('outlet_type') == $outletType)
                  <option value="{{  $key }}" selected>{{  $outletType }}</option>
              @else
                  <option value="{{  $key }}">{{  $outletType }}</option>
              @endif
          @endforeach
      </select>
      @if ($errors->has('outlet_type'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('outlet_type') }}</strong>
          </span>
      @endif
  </div>
  <div class="col-md-5 form-group">
      <label for="outlet_code" class="control-label">Outlet Code</label>
      <input type="text" name="outlet_code" value="{{old('outlet_code') }}" class="form-control{{ $errors->has('outlet_code') ? ' is-invalid' : '' }}" id="outlet_code" placeholder="e.g. BR-001">
      @if ($errors->has('outlet_code'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('outlet_code') }}</strong>
          </span>
      @endif
  </div>
</div>

@include('locationmanagement::addresses._form')

<div class="border rounded p-3 mb-3 bg-light">
  <div class="mb-2">
      <strong>Add New Location (Optional)</strong>
      <small class="d-block text-muted">Use this only if the state/city is not already in the dropdown.</small>
  </div>
  <div class="form-row">
      <div class="col-md-4 form-group mb-2">
          <label for="country_code">Country</label>
          <select id="country_code" name="country_code" class="custom-select select2 w-100 {{ $errors->has('country_code') ? ' is-invalid' : '' }}">
              <option value="">Choose Country</option>
              @if(isset($countries))
                  @foreach($countries as $key => $country)
                      @if(old('country_code') == $key)
                          <option value="{{$key}}" selected>{{ $country }}</option>
                      @else
                          <option value="{{$key}}">{{ $country }}</option>
                      @endif
                  @endforeach
              @endif
          </select>
          @if ($errors->has('country_code'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('country_code') }}</strong>
              </span>
          @endif
      </div>
      <div class="col-md-4 form-group mb-2">
          <label for="state_name">State / Region</label>
          <input type="text" name="state_name" value="{{ old('state_name') }}" class="form-control{{ $errors->has('state_name') ? ' is-invalid' : '' }}" id="state_name" placeholder="Enter state">
          @if ($errors->has('state_name'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('state_name') }}</strong>
              </span>
          @endif
      </div>
      <div class="col-md-4 form-group mb-2">
          <label for="city_name">City</label>
          <input type="text" name="city_name" value="{{ old('city_name') }}" class="form-control{{ $errors->has('city_name') ? ' is-invalid' : '' }}" id="city_name" placeholder="Enter city">
          @if ($errors->has('city_name'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('city_name') }}</strong>
              </span>
          @endif
      </div>
  </div>
</div>

<div class="form-group">
  <label for="telephone" class="control-label">Outlet telephone</label>       
  <input type="text" name="telephone" value="{{old('telephone') }}" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" id="telephone" placeholder="Outlet Number">
  @if ($errors->has('telephone'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('telephone') }}</strong>
      </span>
  @endif  
</div>
