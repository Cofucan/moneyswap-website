
<label for="attachment" class="control-label">Attach File</label>
<input type="file" class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }} pull-right" name="attachment"  value="{{old ('attachment')}}"/>
@if ($errors->has('attachment'))
  <span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('attachment') }}</strong>
  </span>
@endif