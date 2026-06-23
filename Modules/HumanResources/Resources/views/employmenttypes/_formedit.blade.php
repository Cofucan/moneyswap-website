humanresources::    <div class="form-group">
        <label for="employment_type"> Employment Type</label>
        <input type="text" name="employment_type" value="{{$employmentType->employment_type}}" class="form-control" placeholder="Enter EmployeeCategory title"  id="employment_type" />
        @if ($errors->has('employment_type'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('employment_type') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="tag"> Employment Tag </label>
        <input type="text" name="tag" value="{{$employmentType->tag}}" class="form-control" placeholder="Enter EmployeeCategory Code"  id="tag" />
        @if ($errors->has('tag'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('tag') }}</strong>
            </span>
        @endif
    </div>

        <label for="description">Description</label>
        <textarea name="description" class="form-control">
            {!! $employmentType->description !!}
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
