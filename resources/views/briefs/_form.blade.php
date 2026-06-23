                <div class="input-group">
                    <input class="input--style-1" type="text" placeholder="Name" name="contact_name">
                  </div>
                  
                <div class="row row-space">
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1" type="email" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1" type="phone" placeholder="Telephone" name="telephone">
                        </div>
                    </div>
                </div>
               

                <div class="input-group">
                    <div class="rs-select2 js-select-simple select--no-search">
                        <select name="organization_type_id">
                            <option disabled="disabled" selected="selected">Choose Service</option>
                            @foreach($expertises as $expertise)
                              @if( old('expertise_id') == $expertise->id)
                                  <option value="{{$expertise->id}}" selected> {{$expertise->label}}</option>
                              @else
                                  <option value="{{$expertise->id}}"> {{$expertise->label}}</option>
                              @endif
                            @endforeach
                            
                        </select>
                        <div class="select-dropdown"></div>
                    </div>
                </div>
             
              
                <div class="form-group">
                    <label for="brief_details">Additional Information</label>
                    <textarea name="brief_details" class="form-control text-area" placeholder="Enter Enter Post content" id="whyus"> {!! old('brief_details') !!} </textarea>
                    @if ($errors->has('brief_details'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('brief_details') }}</strong>
                        </span>
                    @endif
                </div>  
