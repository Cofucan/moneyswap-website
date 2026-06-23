<div class="form-group">
    <label for="message_body">Message</label>
    <textarea name="message_body" class="form-control" rows="4" id="{{ $message->id }}" >
        {!! Old('message_body') !!}
    </textarea>
    @if ($errors->has('message_body'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('message_body') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="attachments"> Attach Files <span class="required">*</span></label>
    <input type="file" name="attachments[]" value="{{  old('attachments') }}" class="form-control{{ $errors->has('attachments') ? ' is-invalid' : '' }}"   multiple="multiple" id="attachments" />
    @if ($errors->has('attachments'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('attachments') }}</strong>
        </span>
    @endif
  </div>
 