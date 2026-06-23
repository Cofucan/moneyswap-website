                <div class="input-group">
                    <input class="input--style-1" type="text" placeholder="Name" name="reviewer_name">
                </div>
                  
                <div class="row row-space">
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Identity" name="reviewer_identy">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Rate" name="rankweight">
                        </div>
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
