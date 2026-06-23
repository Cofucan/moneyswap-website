    <div class="form-group">      
        <div class="input-group">
          <div class="input-group-append">
            <div class="input-group-text"><i class="fa fa-phone"></i></div>
          </div>
          <input type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" id="telephone" value="{{  old('telephone') }}" required>
          <div class="input-group-prepend">
            <select class="custom-select w-100 select2" id="phone_tag" name="phone_tag">                
              @foreach($phoneTags as $key => $phoneTag)
                @if(old('phone_tag') == $key)
                    <option value="{{  $key }}" selected>{{  $phoneTag }}</option>
                @else
                    <option value="{{  $key }}">{{  $phoneTag }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
    </div>

 