  <div class="form-row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="last_name" class="control-label">Full Name </label>
        <div class="input-group">
          <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-user"></i></div>
          </div>
          <input type="text" name="last_name" value="{{old('last_name') }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" placeholder="Last Name "required>
        </div>                                   
        @if ($errors->has('last_name'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('last_name') }}</strong>
          </span>
        @endif    
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="first_name" class="control-label">.</label>
        <input type="text" name="first_name" value="{{old('first_name') }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="First Name" required>
        @if ($errors->has('first_name'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('first_name') }}</strong>
          </span>
        @endif
      </div>
    </div>              
  </div>

  <div class="form-group">
    <label for="legal_name" class="control-label">Company Name </label>
    <input type="text" name="legal_name" value="{{old('legal_name') }}" class="form-control{{ $errors->has('legal_name') ? ' is-invalid' : '' }}" id="legal_name" placeholder="Company Name">
    @if ($errors->has('legal_name'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('legal_name') }}</strong>
      </span>
    @endif
  </div>

  <div class="form-group">
    <label class="form-control-label text-muted">Email</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-envelope"></i></div>
        </div>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
    </div>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>   

    <div class="form-group">
      <label class="form-control-label text-muted">Telephone <span class="text-grey"><small>required</small></span></label>
      <div class="input-group">
          <div class="input-group-prepend">                         
              <div class="input-group-text">+234</div>
          </div>
          <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required>
      </div>
      @error('telephone')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

  </div>
            
