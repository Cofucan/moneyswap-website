<div class="form-group">
    <label for="label"> Label </label>
    <input type="text" name="label" value="{{old('label')}}" class="form-control" placeholder=""  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-row">
    <div class="col-md-6 form-group">
        <label for="icon"> Icon </label>
        <input type="file" name="icon" value="{{old('icon')}}" class="form-control"  id="icon" />
        @if ($errors->has('icon'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('icon') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6 form-group">
        <label for="display_image"> Display Image </label>
        <input type="file" name="display_image" value="{{old('display_image')}}" class="form-control"  id="display_image" />
        @if ($errors->has('display_image'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('display_image') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <label for="practitioner">Practitional<span class="required">*</span></label>
        <input type="text" name="practitioner" value="{{old('practitioner')}}" class="form-control"  id="practitioner" />
        @if ($errors->has('practitioner'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('practitioner') }}</strong>
            </span>
        @endif
    </div>
    
    <div class="col-md-6 form-group">
        <label for="industry">Department <span class="required">*</span></label>
        <input type="text" name="industry" value="{{old('industry')}}" class="form-control"  id="industry" />
        </select>
        @if ($errors->has('industry'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('industry') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group ">
    <label for="overview">Description</label>
    <textarea name="overview" class="form-control" rows="4">
        {!! old('overview') !!}
    </textarea>
    @if ($errors->has('overview'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('overview') }}</strong>
        </span>
    @endif
</div>

    {{-- <div class="form-row">
        <div class="col-md-12 mt-2">
            <button class="btn btn-sm btn-danger reveal pull-right"><b>More Details</b></button>
            <div class="toggle_container" id="Description">
                <div class="form-group ">
                    <label for="overview">Description</label>
                    <textarea name="overview" class="form-control">
                        {!! old('overview') !!}
                    </textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label>Favicon</label>
                        <input id="favicon" type="file" class="form-control" name="favicon">
                        @if ($errors->has('favicon'))
                        <span class="invalid-feedback glyphicon glyphicon-remove">
                        <strong>{{ $errors->first('favicon') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Official Logo</label>
                        <input id="official_logo" type="file" class="form-control" name="official_logo">
                        @if ($errors->has('official_logo'))
                        <span class="invalid-feedback glyphicon glyphicon-remove">
                        <strong>{{ $errors->first('official_logo') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>                                                
            </div>

        </div>
    </div> --}}


