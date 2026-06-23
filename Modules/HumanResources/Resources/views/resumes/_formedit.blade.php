
<div class="form-group">
  <label for="designation_id">Job Role</label>
  <select class="custom-select d-block w-100 select2{{ $errors->has('designation_id') ? ' is-invalid' : '' }}" name="designation_id" id="parent">
       @foreach($designations as $key => $designation)
       @if($resume->designation_id == $key)
       <option value="{{$key}}" selected> {{$designation}}</option>
        @else
        <option value="{{$key}}"> {{$designation}}</option>
        @endif
    @endforeach
    </select>
    @if ($errors->has('designation_id'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('designation_id') }}</strong>
            </span>
    @endif
</div>
<div class="form-group">
  <label for="career_objective">Career Objective <span class="required">*</span></label>
  <textarea name="career_objective" class="form-control {{ $errors->has('career_objective') ? ' is-invalid' : '' }}" rows="3">
      {{$resume->career_objective}}
  </textarea>
  @if ($errors->has('career_objective'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('career_objective') }}</strong>
      </span>
  @endif
</div>


