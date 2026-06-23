<div class="form-group">
    <label for="label"> Label </label>
    <input type="text" name="label" value="{{$division->label}}" class="form-control" placeholder=""  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="practitioner">Practitional<span class="required">*</span></label>
    <input type="text" name="practitioner" value="{{$division->practitioner}}" class="form-control"  id="practitioner" />
    @if ($errors->has('practitioner'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('practitioner') }}</strong>
        </span>
    @endif
  
</div>
<div class="form-row">
    <div class="col-md-6 form-group">
        <label for="icon"> icon </label>
        <input type="text" name="icon" value="{{$division->icon}}" class="form-control"  id="icon" />
        @if ($errors->has('icon'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('icon') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6 form-group">
        <label>Display Image</label>
        <input id="display_image" type="file" class="form-control" name="display_image">
        @if ($errors->has('display_image'))
        <span class="invalid-feedback glyphicon glyphicon-remove">
        <strong>{{ $errors->first('display_image') }}</strong>
        </span>
        @endif
    </div>
</div>   

<div class="form-group ">
    <label for="overview">Description</label>
    <textarea name="overview" class="form-control">
        {!! $division->overview !!}
    </textarea>
    @if ($errors->has('overview'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('overview') }}</strong>
        </span>
    @endif
</div>  
   