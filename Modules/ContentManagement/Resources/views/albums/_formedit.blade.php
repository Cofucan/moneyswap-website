<div class="form-group">
        <label for="label">Album Name <span class="required">*</span></label>
        <input type="text" name="label" value="{{$album->label}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter Album Name"  id="label" required autofocus/>
        @if ($errors->has('label'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('label') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group ">
        <label for="overview">Description<span class="required">*</span></label>
        <textarea name="overview" class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}" rows="2">{!! $album->overview !!} </textarea>
        @if ($errors->has('overview'))
            <span class="invalid-feedback">
            <strong>{!! $errors->first('overview') !!}</strong>
            </span>
        @endif
    </div>

