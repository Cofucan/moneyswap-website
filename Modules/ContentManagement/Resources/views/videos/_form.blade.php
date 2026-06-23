<div class="form-group">
    <label for="label">Video Title <span class="required">*</span></label>
    <input type="text" name="label" value="{{old('label')}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter Video Title"  id="label" required/>
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-group ">
    <label for="link">Video Link <span class="required">*</span></label>
    <textarea name="link" class="form-control {{ $errors->has('link') ? ' is-invalid' : '' }}" rows="2" placeholder="Enter Youtube Link"  required>{{ old('link') }} </textarea>
    
    @if ($errors->has('link'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('link') }}</strong>
        </span>
    @endif
</div>



