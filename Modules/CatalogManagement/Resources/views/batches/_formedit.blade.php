<div class="form-group">
  <label for="label"> Label</label>
  <input type="text" name="label" value="{{ $batch->label}}" class="form-control" id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>
<div class="form-row">
    <div class="col-md-6 form-group">
      <label for="number"> Minimum Subjects</label>
      <input type="text" name="mandatory_subjects" value="{{ $batch->mandatory_subjects}}" class="form-control" id="mandatory_subjects" />
        @if ($errors->has('mandatory_subjects'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('mandatory_subjects') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6 form-group">
      <label for="elective_subjects"> Maximum Subjects</label>
      <input type="number" name="elective_subjects" value="{{ $batch->elective_subjects}}" class="form-control" id="elective_subjects" />
        @if ($errors->has('elective_subjects'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('elective_subjects') }}</strong>
            </span>
        @endif
    </div>
  </div>
