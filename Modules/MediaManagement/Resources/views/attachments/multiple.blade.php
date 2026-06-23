<label for="attachments"> Attach Image/File </label>
    <input type="file" name="attachments[]" class="form-control {{ $errors->has('attachments') ? ' is-invalid' : '' }}"  id="attachments" multiple/>
    @if ($errors->has('attachments'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('attachments') }}</strong>
        </span>
    @endif