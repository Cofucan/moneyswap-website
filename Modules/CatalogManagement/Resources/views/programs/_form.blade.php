    <div class="form-group">
        <label for="section_name"> Section Name</label>
        <input type="text" name="section_name" value="{{old('section_name')}}" class="form-control {{ $errors->has('section_name') ? ' is-invalid' : '' }}" placeholder="Enter program title"  id="section_name"/>
        @if ($errors->has('section_name'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('section_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="section_tenure"> Section Tenure</label>
        <input type="text" name="section_tenure" value="{{old('section_tenure')}}" class="form-control {{ $errors->has('section_tenure') ? ' is-invalid' : '' }}" placeholder="Enter program Tenure"  id="section_tenure"/>
        @if ($errors->has('section_tenure'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('section_tenure') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group ">
        <label for="section_description">Description</label>
        <textarea name="section_description" class="form-control {{ $errors->has('section_description') ? ' is-invalid' : '' }}" rows="5">
            {{old('section_description')}}
        </textarea>
        @if ($errors->has('section_description'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('section_description') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="display_image">Display Image</label>
        <input type="file" name="display_image" value="{{old('display_image')}}" class="form-control {{ $errors->has('display_image') ? ' is-invalid' : '' }}" placeholder="Upload  Image"  id="display_image" />
        @if ($errors->has('display_image'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('display_image') }}</strong>
            </span>
        @endif
    </div>
    
    <div class="form-group">
        <label for="graduation_qualification"> Graduation Qualification</label>
        <input type="text" name="graduation_qualification" value="" class="form-control{{ $errors->has('graduation_qualification') ? ' is-invalid' : '' }}" placeholder="Target URL"  id="graduation_qualification" />
        @if ($errors->has('graduation_qualification'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('graduation_qualification') }}</strong>
            </span>
        @endif
    </div>
