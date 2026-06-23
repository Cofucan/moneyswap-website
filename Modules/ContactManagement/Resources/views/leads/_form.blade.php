  @include('contactmanagement::contacts.completeform')
  
  <div class="form-group row mb-3">
    <label for="email" class="control-label col-md-3">Position</label>
    <div class="col-md-8">
      <select class="custom-select w-100 select2" id="designation_id" name="designation_id">                
        @foreach($designations as $key => $designation)
          @if(old('designation_id') == $key)
              <option value="{{  $key }}" selected>{{  $designation }}</option>
          @else
              <option value="{{  $key }}">{{  $designation }}</option>
          @endif
        @endforeach
    </select>      
    </div>
  </div>

  
