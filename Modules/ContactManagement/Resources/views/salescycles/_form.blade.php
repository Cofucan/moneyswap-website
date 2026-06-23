<div class="form-group">
    <label for="label">Sales Cycle</label>
    <input type="text" name="label" value="{{old('label')}}" class="form-control" placeholder="Cycle Title"  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="sequence"> Sequence </label>
    <input type="number" name="sequence" value="{{old('sequence')}}" class="form-control"   id="sequence" />
    @if ($errors->has('sequence'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('sequence') }}</strong>
        </span>
    @endif
</div>

<div class="form-group ">
    <label for="overview">Overview</label>
    <textarea name="overview" class="form-control" rows="3">{!! old('overview') !!}</textarea>
    @if ($errors->has('overview'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('overview') }}</strong>
        </span>
    @endif
</div>