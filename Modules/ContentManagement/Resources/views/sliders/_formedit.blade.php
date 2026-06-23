
    <div class="form-group">
        <label for="caption"> Slider Caption</label>
        <input type="text" name="caption" value="{{$slider->caption}}"  class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}"/>
        @if ($errors->has('caption'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('caption') }}</strong>
            </span>
        @endif
    </div> 
    
    <div class="form-group ">
        <label for="highlight">Slider Highlight</label>
        <textarea name="highlight" class="form-control {{ $errors->has('highlight') ? ' is-invalid' : '' }}" rows="1">{!! $slider->highlight !!}</textarea>
        @if ($errors->has('highlight'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('highlight') }}</strong>
            </span>
        @endif
    </div>
    
    <div class="form-row">
        <div class="col-md-12">
            <label for="buttone_one"> Button One</label>
        </div>
        <div class="col-md-6">
            <div class="form-group ">
                <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">Text</div>
                </div>
                <input type="text" name="button_one" value="{{ $slider->button_one}}" class="form-control{{ $errors->has('button_one') ? ' is-invalid' : '' }}"/>
                @if ($errors->has('button_one'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('button_one') }}</strong>
                    </span>
                @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group ">
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">Link</div>
                    </div>
                    <input type="text" name="button_one_link" value="{{ $slider->button_one_link}}" class="form-control{{ $errors->has('button_one_link') ? ' is-invalid' : '' }}"/>
                    @if ($errors->has('button_one_link'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('button_one_link') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col-md-12">
            <label for="button_two"> Button Two</label>
        </div>
        <div class="col-md-6">
            <div class="form-group ">
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">Text</div>
                    </div>
                    <input type="text" name="button_two" value="{{ $slider->button_two}}" class="form-control{{ $errors->has('button_two') ? ' is-invalid' : '' }}"/>
                    @if ($errors->has('button_two'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('button_two') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">Link</div>
                    </div>
                    <input type="text" name="button_two_link" value="{{ $slider->button_two_link}}" class="form-control{{ $errors->has('button_two_link') ? ' is-invalid' : '' }}"/>
                    @if ($errors->has('button_two_link'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('button_two_link') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>