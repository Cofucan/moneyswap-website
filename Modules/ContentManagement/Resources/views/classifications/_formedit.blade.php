<div class="form-group mb-5">
    <label for="label"> Label </label>
    <input type="text" name="label" value="{{$classification->label}}" class="form-control" placeholder="e.g Lagos"  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
  </div>