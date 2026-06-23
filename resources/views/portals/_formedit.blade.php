
                <div class="form-row">
                    <div class="col-md-12 form-group">
                        <label class="control-label" for="email">Portal Email</label>
                        <input type="email" value="{{$portal->email }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email">
                        
                        
                        @if ($errors->has('email'))
                            <span class="invalid-feedback glyphicon glyphicon-remove form-control">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-12 form-group">
                        <label class="control-label" for="telephone">Portal Phone Number</label>
                        <input type="tel" value="{{$portal->telephone }}" class="form-control {{ $errors->has('telephone') ? ' is-invalid' : '' }}" id="telephone" name="telephone" maxlength="36">
                                                
                        @if ($errors->has('telephone'))
                            <span class="invalid-feedback glyphicon glyphicon-remove form-control">
                            <strong>{{ $errors->first('telephone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            
              

           