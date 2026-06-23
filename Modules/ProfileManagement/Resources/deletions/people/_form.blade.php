            <div class="form-row mb-4">
              <div class="col-md-5 ">
                <label for="last_name" class="control-label">Full Name</label>
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
          
              <div class="col-md-4 ">
                <label for="first_name" class="control-label">.</label>
               
                  <input type="text" name="first_name" value="{{old('first_name') }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="First Name" required>
                
                  @if ($errors->has('first_name'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('first_name') }}</strong>
                  </span>
                  @endif
              </div>

              <div class="col-md-3 ">
                <label for="middle_name" class="control-label">.</label>
                
                  <input type="text" name="middle_name" value="{{old('middle_name') }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name" placeholder="Middle Name">
                
                  @if ($errors->has('middle_name'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('middle_name') }}</strong>
                  </span>
                  @endif
              </div>
        </div>
                              
          <div class="form-row mb-4">
            <div class="col-md-6 ">
              <label for="birthday" class="control-label">Date of birth</label>
              <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="text" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }} pull-right" name="birthday"  value="{{old ('birthday')}}">
              </div>
              @if ($errors->has('birthday'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('birthday') }}</strong>
                </span>
              @endif
            </div>

            <div class="col-md-5 offset-md-1 ">
              <label for="gender" class="control-label"> Gender </label><br>
          
              <div class="custom-control custom-radio custom-control-inline">
                  <input id="male" name="gender" type="radio" value="Male" class="custom-control-input" required>
                  <label class="custom-control-label" for="male">Male</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                  <input id="Female" name="gender" type="radio" value="Female" class="custom-control-input" required>
                  <label class="custom-control-label" for="Female">Female</label>
              </div>                                  
            </div>          
          </div>
            
