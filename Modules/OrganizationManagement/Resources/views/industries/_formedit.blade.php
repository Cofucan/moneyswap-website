
    <div class="form-group">
        <label for="industry_name"> Label </label>
        <input type="text" name="industry_name" value="{{$industry->industry_name}}" class="form-control" placeholder=""  id="industry_name" />
        @if ($errors->has('industry_name'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('industry_name') }}</strong>
            </span>
        @endif
    </div>
