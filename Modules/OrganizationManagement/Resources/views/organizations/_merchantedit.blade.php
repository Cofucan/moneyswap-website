<div class="form-group mb-4">

    <label class="control-label" for="organization_name">Legal Name (required)&nbsp;<span class="requiredfield">*</span></label>
    <input type="text" value="{{ $merchant->Profile->Organization->organization_name }}" class="form-control{{ $errors->has('organization_name') ? ' is-invalid' : '' }}" id="organization_name" name="organization_name" placeholder="Legal Name">

    @if ($errors->has('organization_name '))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('organization_name ') }}</strong>
      </span>
    @endif

</div>

<div class="form-row mb-4">
  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label class="control-label" for="trading_name">Trading Name</span></label>
    <input type="text" class="form-control" id="trading_name" name="trading_name" value="{{$merchant->Profile->Organization->trading_name }}"  placeholder="Enter Common Name">
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label class="control-label">Reg Number</label>
    <input type="text" class="form-control{{ $errors->has('reg_number') ? ' is-invalid' : '' }}" id="reg_number" name="reg_number" placeholder="Enter Registration Number" value="{{$merchant->Profile->Organization->reg_number}}" >
    @if ($errors->has('reg_number'))
        <span class="invalid-feedback glyphicon glyphicon-remove">
        <strong>{{ $errors->first('reg_number') }}</strong>
        </span>
      @endif
  </div>
</div>

