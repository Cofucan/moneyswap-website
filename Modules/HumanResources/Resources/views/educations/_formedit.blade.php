

<div class="form-row">
  <div class="col-md-6 form-group">
    <label for="qualification">Degree Obtained <span class="required">*</span></label>
    <select name="qualification" class="custom-select d-block w-100 select2 {{ $errors->has('qualification') ? ' is-invalid' : '' }}" id="qualification">
      @foreach($qualifications as $key => $qualification)
        @if($education->qualification_id == $key)
          <option value="{{$key}}" selected> {{$qualification}}</option>
        @else
          <option value="{{$key}}"> {{$qualification}}</option>
        @endif

      @endforeach
    </select>
    @if ($errors->has('qualification'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('qualification') }}</strong>
      </span>
    @endif
  </div>

  <div class="col-md-6 form-group">
    <label for="major">Course Studied </label>
    <input type="text" name="major" value="{{$education->major}}" class="form-control{{ $errors->has('major') ? ' is-invalid' : '' }}"   id="major"/>
    @if ($errors->has('major'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('major') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-row">
  <div class="col-md-6 mb-3 form-group">
    <label class="control-label" for="started_at">Start Date</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
        <input type="text" class="form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }} pull-right" name="started_at"  value="{{$education->started_at}}">
    </div>

    @if ($errors->has('started_at'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('started_at') }}</strong>
        </span>
    @endif
  </div>

  <div class="col-md-6 form-group">
    <label for="completed_at">End Date</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
        <input type="text" name="completed_at" value="{{$education->completed_at}}" class="form-control{{ $errors->has('completed_at') ? ' is-invalid' : '' }}" />
    </div>
    @if ($errors->has('completed_at'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('completed_at') }}</strong>
        </span>
    @endif
  </div>
</div>

<div class="form-row">
  <div class="col-md-6 form-group">
    <label for="cgpa">Graduation Level/Class</label>
    <input type="text" name="cgpa" value="{{$education->cgpa}}" class="form-control{{ $errors->has('cgpa') ? ' is-invalid' : '' }}"  id="cgpa"/>
    @if ($errors->has('cgpa'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('cgpa') }}</strong>
      </span>
    @endif
  </div>


</div>



