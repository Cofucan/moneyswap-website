
<div class="form-row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="label">Country Name</label>
            <input type="text" name="label" value="{{old('label')}}" class="form-control" placeholder="Enter currency Label"  id="label" />
            @if ($errors->has('label'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('label') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="code"> Code</label>
            <input type="text" name="code" value="{{old('code')}}" class="form-control" placeholder="Country Acronym"  id="code" />
            @if ($errors->has('code'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('code') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>



<div class="form-group ">
    <label for="dialling_code">Phone Code</label>
    <input type="text" name="dialling_code" value="{{old('dialling_code')}}" class="form-control" placeholder="Country Telephone code"  id="dialling_code" />
    @if ($errors->has('dialling_code'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('dialling_code') }}</strong>
        </span>
    @endif
</div>


