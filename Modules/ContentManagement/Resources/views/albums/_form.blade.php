<div class="form-group">
        <label for="label">Album Name <span class="required">*</span></label>
        <input type="text" name="label" value="{{old('label')}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter Album Name"  id="label" required autofocus/>
        @if ($errors->has('label'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('label') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group ">
        <label for="overview">Overview <span class="required">*</span></label>
        <textarea name="overview" class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}">
            {{old('overview')}}
        </textarea>
        @if ($errors->has('overview'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('overview') }}</strong>
            </span>
        @endif
    </div>

    {{-- <div class="form-group">
        <label for="display_image">Album Image<span class="required">*</span></label>
        <input type="file" name="display_image" value="{{old('display_image')}}" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}" placeholder="Upload  Image"  id="display_image" required/>
        @if ($errors->has('display_image'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('display_image') }}</strong>
            </span>
        @endif
    </div> --}}

