    <div class="form-group">
        <label class="control-label" for="telephone_type">Telephone Type</label>
        <div class="input-group">
         
          <input type="text" name="phone_number" id="phone_number" value="{{  $telephone->phone_number }}" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" required>
          <div class="input-group-prepend">
            <select class="custom-select w-100 select2" id="phone_tag" name="phone_tag">
         
                  @foreach($phoneTags as $key => $phoneTag)
                      @if($telephone->telephone_tag == $key)
                          <option value="{{  $key }}" selected>{{  $phoneTag }}</option>
                      @else
                          <option value="{{  $key }}">{{  $phoneTag }}</option>
                      @endif
                  @endforeach

            </select>
          </div>
        </div>
    </div>

    

