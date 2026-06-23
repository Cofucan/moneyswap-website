<div class="form-group">
    <label for="label">Class Name <span class="required">*</span> </label>
    <input type="text" name="label" value="{{old('label')}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Class Title"  id="label" required/>
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
  </div>
  @if($levels->count() > 0)
    <div class="form-group">
      <label for="parent_id">Previous Class</label>
      <select class="custom-select d-block w-100 select2"  name="parent_id" id="parent_id">
      <option value="0"> Select previous level</option>
            @foreach($levels as $key => $level)
            @if(old('parent_id') == $key)
            <option value="{{$key}}" selected> {{$level}}</option>
              @else
              <option value="{{$key}}"> {{$level}}</option>
              @endif
          @endforeach
      </select>
      @if ($errors->has('parent_id'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('parent_id') }}</strong>
          </span>
      @endif
    </div>
  @endif

  <div class="form-group">
    <label for="overview">Remarks</label>
    <textarea name="overview" class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" placeholder="Enter remark">{{ old('overview') }}
    </textarea>
    @if ($errors->has('overview'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('overview') }}</strong>
        </span>
    @endif
  </div>
