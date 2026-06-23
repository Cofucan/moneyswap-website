<div class="form-group">
    <label for="employment_type"> Employment Type</label>
    <input type="text" name="employment_type" value="{{old('employment_type')}}" class="form-control" placeholder="E"  id="employment_type" />
    @if ($errors->has('employment_type'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('employment_type') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="tag"> Employment Tag </label>
    <input type="text" name="tag" value="{{old('tag')}}" class="form-control"   id="tag" />
    @if ($errors->has('tag'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('tag') }}</strong>
        </span>
    @endif
</div>

<div class="form-group ">
    <label for="description">Operational Description</label>
    <textarea name="description" class="form-control">
        {!! old('description') !!}
    </textarea>
    @if ($errors->has('description'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

<div class="custom-control custom-checkbox custom-control-inline">
    <input id="published" name="published" type="checkbox" value="1" class="custom-control-input" checked>
    <label class="custom-control-label" for="published">Publish</label>
</div>
