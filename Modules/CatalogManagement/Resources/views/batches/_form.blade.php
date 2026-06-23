<div class="form-row">
    <div class="col-md-6 form-group">
        <label for="grade_id"> Class</label>
        <select name="grade_id" class="custom-select d-block w-100 select2" id="level" required>
            @foreach($levels as $key => $level)
            <option value="{{$key}}"> {{$level}}</option>
            @endforeach
        </select>
        @if ($errors->has('grade_id'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('grade_id') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6 form-group">
      <label for="stream_id"> Stream</label>
      <select name="stream_id" class="custom-select d-block w-100 select2" id="stream" required>
        @foreach($streams as $key => $stream)
        <option value="{{$key}}"> {{$stream}}</option>
        @endforeach
    </select>
        @if ($errors->has('stream_id'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('stream_id') }}</strong>
            </span>
        @endif
    </div>
  </div>
    <div class="form-row">
      <div class="col-md-6 form-group">
        <label for="mandatory_subjects"> Compulsory Subjects</label>
        <input type="number" name="mandatory_subjects" value="{{ old('mandatory_subjects')}}" class="form-control" id="mandatory_subjects" />
          @if ($errors->has('mandatory_subjects'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('mandatory_subjects') }}</strong>
              </span>
          @endif
      </div>

      <div class="col-md-6 form-group">
        <label for="elective_subjects"> Maximum Subjects</label>
        <input type="number" name="elective_subjects" value="{{ old('elective_subjects')}}" class="form-control" id="elective_subjects" />
          @if ($errors->has('elective_subjects'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('elective_subjects') }}</strong>
              </span>
          @endif
      </div>
    </div>
