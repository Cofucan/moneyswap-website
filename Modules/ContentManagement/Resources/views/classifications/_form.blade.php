<div class="form-group mb-5">
  <label for="label"> Category Name </label>
  <input type="text" name="label" value="{{old('label')}}" class="form-control" placeholder="e.g posts"  id="label" />
  @if ($errors->has('label'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('label') }}</strong>
      </span>
  @endif
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="published" id="published" value="1">
  <label class="form-check-label" for="published">  Published </label>
</div>