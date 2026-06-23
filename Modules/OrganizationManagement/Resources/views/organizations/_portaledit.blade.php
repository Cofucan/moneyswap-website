<div class="form-group mb-4">

    <label class="control-label" for="organization_name">Legal Name (required)&nbsp;<span class="requiredfield">*</span></label>
    <input type="text" value="{{ $portal->Organization->organization_name }}" class="form-control{{ $errors->has('organization_name') ? ' is-invalid' : '' }}" id="organization_name" name="organization_name" placeholder="Legal Name">

    @if ($errors->has('organization_name '))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('organization_name ') }}</strong>
      </span>
    @endif

</div>

<div class="form-row mb-4">
  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label class="control-label" for="trading_name">Trading Name</span></label>
    <input type="text" class="form-control" id="trading_name" name="trading_name" value="{{$portal->Organization->trading_name }}" >
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label class="control-label">Reg Number</label>
    <input type="text" class="form-control{{ $errors->has('reg_number') ? ' is-invalid' : '' }}" id="reg_number" name="reg_number" value="{{$portal->Organization->reg_number}}" >
    @if ($errors->has('reg_number'))
        <span class="invalid-feedback glyphicon glyphicon-remove">
        <strong>{{ $errors->first('reg_number') }}</strong>
        </span>
      @endif
  </div>
</div>

<div class="form-row">
  <div class="col-md-6 form-group">
    <label>Official Logo</label>
    <input id="official_logo" type="file" class="form-control" name="official_logo">
    @if ($errors->has('official_logo'))
      <span class="invalid-feedback glyphicon glyphicon-remove">
      <strong>{{ $errors->first('official_logo') }}</strong>
      </span>
    @endif
  </div>
  <div class="col-md-6 form-group">
    <label>Fav Icon</label>
    <input id="favicon" type="file" class="form-control" name="favicon">
    @if ($errors->has('favicon'))
      <span class="invalid-feedback glyphicon glyphicon-remove">
      <strong>{{ $errors->first('favicon') }}</strong>
      </span>
    @endif
  </div>
</div>


  <div class="form-group">
    <label>Slogan</label>
    <input type="text" class="form-control{{ $errors->has('slogan') ? ' is-invalid' : '' }}" id="slogan" name="slogan" value="{{$portal->Organization->slogan}}" >
    @if ($errors->has('slogan'))
      <span class="invalid-feedback glyphicon glyphicon-remove">
      <strong>{{ $errors->first('slogan') }}</strong>
      </span>
    @endif
  </div>
  
<div class="form-row">
  <div class="col-md-12">
      <button class="btn btn-sm btn-danger reveal pull-right"><b>Add More Details</b></button>
      <div class="toggle_container" id="Description">
        <div class="form-group">
          <label for="vision">Vision</label>
          <textarea name="vision" class="form-control {{ $errors->has('vision') ? ' is-invalid' : '' }}" rows="3">
              {!!$portal->Organization->vision!!}
          </textarea>
          @if ($errors->has('vision'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('vision') }}</strong>
              </span>
          @endif
        </div>
      
      <div class="form-group">
        <label for="mission">Mission </label>
        <textarea name="mission" class="form-control {{ $errors->has('mission') ? ' is-invalid' : '' }}" rows="3">
            {!!$portal->Organization->mission!!}
        </textarea>
        @if ($errors->has('mission'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('mission') }}</strong>
            </span>
        @endif
      </div>
                   
      </div>

  </div>
</div>
