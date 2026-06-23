
<div class="form-group">
     <label class="control-label" for="academic_term_id">Academic Term</label>
    <select name="academic_term_id" class="custom-select d-block w-100 select2" id="academicterm" required>
    @foreach($academicterms as $key => $academicterm)
    <option value="{{$key}}"> {{$academicterm}}</option>
    @endforeach
    </select>
    @if ($errors->has('academic_term_id'))
    <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('academic_term_id') }}</strong>
    </span>
    @endif
</div>
 <div class="form-row">
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="outlet">Outlet</label>
            <select name="outlet_id" class="custom-select select2" id="outlet" required>
                <option value="">Select Clients Outlet </option>
                @foreach($outlets as $key => $outlet)
                <option value="{{$key}}"> {{$outlet}}</option>
                @endforeach
            </select>
            @if ($errors->has('outlet_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('outlet_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label class="control-label" for="batch_id">Class</label>
            <select name="batch_id" class="custom-select d-block w-100 select2" id="batch" required>
            @foreach($batches as $key => $batch)
            <option value="{{$key}}"> {{$batch}}</option>
            @endforeach
            </select>
            @if ($errors->has('batch_id'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('batch_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group ">
    <label for="overview"> Description</label>
    <textarea name="overview" class="form-control">
        {!! old('overview') !!}
    </textarea>
    @if ($errors->has('overview'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('overview') }}</strong>
        </span>
    @endif
</div>

