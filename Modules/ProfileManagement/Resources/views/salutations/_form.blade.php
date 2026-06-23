
    <div class="form-group">
        <label for="label"> Label </label>
        <input type="text" name="label" value="{{old('label')}}" class="form-control" placeholder=""  id="label" />
        @if ($errors->has('label'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('label') }}</strong>
            </span>
        @endif
    </div>
