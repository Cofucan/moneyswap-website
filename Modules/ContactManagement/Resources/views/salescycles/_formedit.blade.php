<div class="form-group">
    <label for="label">Sales Cycle</label>
    <input type="text" name="label" value="{{$salescycle->label}}" class="form-control" placeholder="E"  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="sequence"> Sequence </label>
    <input type="number" name="sequence" value="{{$salescycle->sequence}}" class="form-control"   id="sequence" />
    @if ($errors->has('sequence'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('sequence') }}</strong>
        </span>
    @endif
</div>

<div class="form-group ">
    <label for="overview">Overview</label>
    <textarea name="overview" class="form-control" rows="3">{!! $salescycle->overview !!}</textarea>
    @if ($errors->has('overview'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('overview') }}</strong>
        </span>
    @endif
</div>