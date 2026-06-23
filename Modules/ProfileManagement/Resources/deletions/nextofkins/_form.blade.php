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

          <div class="form-row">              
            <div class="col-md-6 mb-3">
            <label for="relationship_id">Relationship with Next of Kin</label>
              <select name="relationship_id" class="custom-select d-block w-100 select2" id="relationship_id" required>
                @foreach ($relationships as $key => $relationship)
                  <option value="{{ $key }}">{{ $relationship }}</option>
                    
                @endforeach
                                
              </select>
              @if ($errors->has('relationship_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('relationship_id') }}</strong>
                        </span>
                      @endif
            </div>

             <div class="col-md-6 ">
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

            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="telephone">Next of Kin Telephone </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text"><i class="fa fa-phone"></i></div>
                  </div>
                  <input type="text" name="telephone" value="{{old('telephone') }}" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" id="telephone" placeholder="e.g 08012345678">
                </div> 
                
                @if ($errors->has('telephone'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('telephone') }}</strong>
                          </span>
                        @endif
              </div>
              <div class="col-md-6 mb-3">
                <label for="email">Next of Kin Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                  </div>
                  <input type="email" name="email" value="{{old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="e.g. name@emailprovider.com">
                </div>
               
                @if ($errors->has('email'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @endif
              </div>
            </div>
