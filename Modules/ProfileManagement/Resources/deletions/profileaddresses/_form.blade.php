<div class="form-group mb-3">
  <label for="address_type" class="control-label">Address Type</label>
  <select class="custom-select w-100 select2" id="address_type" name="address_type">
    @foreach($addressTypes as $address_type)
      @if(old('address_type') == $address_type)
        <option value="{{  $address_type }}" selected>{{  $address_type }}</option>
      @else
        <option value="{{  $address_type }}">{{  $address_type }}</option>
      @endif
    @endforeach
  </select>
  @if ($errors->has('address_type'))
    <span class="invalid-feedback">
      <strong>{{ $errors->first('address_type') }}</strong>
    </span>
  @endif
</div> 
@include('locationmanagement::addresses._form')