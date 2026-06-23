<div class="form-group">
    <label for="label"> Name</label>
    <input type="text" name="label" value="{{ $role->label }}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter role name"  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="overview">Description</label>
    <textarea id="overview" class="form-control" name="overview" rows="4"> {!! $role->overview !!}</textarea>
    @if ($errors->has('overview'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('overview') }}</strong>
        </span>
    @endif
</div>
