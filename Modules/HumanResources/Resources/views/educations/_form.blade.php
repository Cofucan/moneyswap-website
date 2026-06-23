
<input type="hidden" name="industry_id" value="2" id="industry_id" />
  <div class="form-group">
    <label for="qualification_id">Qualification <span class="text-danger">*</span></label>
    <select class="custom-select d-block w-100 select2{{ $errors->has('qualification_id') ? ' is-invalid' : '' }}" name="qualification_id" id="qualification">
        @foreach($qualifications as  $key => $prog)
            @if(old('qualification_id') == $key)
            <option value="{{$key}}" selected> {{$prog}}</option>
            @else
            <option value="{{$key}}"> {{$prog}}</option>
            @endif
        @endforeach
    </select>
      @if ($errors->has('qualification_id'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('qualification_id') }}</strong>
          </span>
      @endif
  </div>

  <div class="form-row" id="qualificationGroupDiv">
    <div class="col-md-6">
      <div class="form-group">
        <label for="title_name">Course Studied <span>*</span></label>
        <input type="text" name="title_name" value="{{old('title_name')}}" class="form-control{{ $errors->has('title_name') ? ' is-invalid' : '' }}"  id="courseField" placeholder="Course Title"/>
        @if ($errors->has('title_name'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('title_name') }}</strong>
          </span>
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="cgpa">Graduation Level/Class </label>
        <input type="text" name="cgpa" value="{{old('cgpa')}}" class="form-control{{ $errors->has('cgpa') ? ' is-invalid' : '' }}" placeholder="Add Level point value"  id="cgpaField"/>
        @if ($errors->has('cgpa'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('cgpa') }}</strong>
          </span>
        @endif
      </div>
    </div>
  </div>

<div class="form-group">
	<label for="organization_name">Institution<span class="text-danger">*</span><small><span class="text-muted">School Attended</span></small></label>
	<input type="text" name="organization_name" value="{{old('organization_name')}}" class="form-control{{ $errors->has('organization_name') ? ' is-invalid' : '' }}"  id="organization_name" required/>
	@if ($errors->has('organization_name'))
		<span class="invalid-feedback">
		<strong>{{ $errors->first('organization_name') }}</strong>
		</span>
	@endif
</div>

<div class="form-row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="control-label" for="started_at">Start Date</label>
      <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
        <input type="date" class="form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }} pull-right" name="started_at"  value="{{old ('started_at')}}">
      </div>

      @if ($errors->has('started_at'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('started_at') }}</strong>
        </span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label for="completed_at">Completion Date</label>
      <div class="input-group">
          <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
          <input type="date" name="completed_at" value="{{old ('completed_at')}}" class="form-control{{ $errors->has('completed_at') ? ' is-invalid' : '' }}"  id="completed_at" />
      </div>
      @if ($errors->has('completed_at'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('completed_at') }}</strong>
          </span>
      @endif
    </div>
  </div>
</div>

@push('scripts')
  <script>
  $("#qualification").change(function() {
    if (['1', '2', '3'].includes($(this).val())) {
      $('#qualificationGroupDiv').hide();
      $('#cgpaField').removeAttr('required');
      $('#cgpaField').removeAttr('data-error');
      $('#courseField').removeAttr('required');
      $('#courseField').removeAttr('data-error');
    } else {
      $('#qualificationGroupDiv').show();
      $('#cgpaField').attr('required', '');
      // $('#cgpaField').attr('data-error', 'This field is required.');
      $('#courseField').attr('required', '');
      $('#courseField').attr('data-error', 'This field is required.');


    }
  });
  $("#qualification").trigger("change");
  </script>
@endpush



