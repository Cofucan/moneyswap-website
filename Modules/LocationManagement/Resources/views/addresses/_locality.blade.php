                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select id="country_code" name="country_code" class="select2 w-100 form-control" title="Please select a cause ...">
                                <option value=""> Choose Country </option>
                                @foreach($countries as $key => $country)
                                    @if(old('country_code') == $key)
                                        <option value="{{$key}}" selected>  {{ $country }} </option>
                                        @else
                                        <option value="{{$key}}">  {{ $country }} </option>
                                    @endif
                                @endforeach
                            </select>
                                @if ($errors->has('country_code'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('country_code') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="state_name" value="{{  old('state_name') }}" class="form-control{{ $errors->has('state_name') ? ' is-invalid' : '' }}" placeholder="Enter State"  id="state_name"/>
                                @if ($errors->has('state_name'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('state_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="city_name" value="{{  old('city_name') }}" class="form-control{{ $errors->has('city_name') ? ' is-invalid' : '' }}" placeholder="Enter city"  id="city_name"/>
                            @if ($errors->has('city_name'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('city_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
