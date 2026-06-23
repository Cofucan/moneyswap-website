
    <div class="form-group">
        <label for="label">Question Category </label>
        <input type="text" name="label" value="{{$incidentcategory->label}}" class="form-control"  id="label" />
        @if ($errors->has('label'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('label') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group ">
        <label for="description">Description</label>
        <textarea name="description" class="form-control">{!! $incidentcategory->description !!}</textarea>
        @if ($errors->has('description'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>

