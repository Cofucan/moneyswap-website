<div class="form-group">
    <label for="department_id"> Department</label>
    <select class="custom-select d-block w-100 select2"  name="department_id" id="school_type" required>
        @foreach ($departments as $key => $department)
        <option value="{{ $key }}">{{ $department }}</option>
        @endforeach
    </select>
    @if ($errors->has('department_id'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('department_id') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="label"> Name</label>
    <input type="text" name="label" value="" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter role name"  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="overview">Description</label>
    <textarea id="overview" class="form-control" rows="4" name="overview" >{{old ('overview')}}</textarea>
    @if ($errors->has('overview'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('overview') }}</strong>
        </span>
    @endif
</div>
