<div class="form-group">
    <label for="sales_cycle_id"> Cycle</label>
    <input type="text" value="{{ $salesaction->cycle }}" class="form-control" id="label" readonly/>
    
</div>

<div class="form-group">
    <label for="label">Label</label>
    <input type="text" name="label" value="{{$salesaction->label}}" class="form-control" placeholder="E"  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="sequence"> Sequence </label>
    <input type="number" name="sequence" value="{{$salesaction->sequence}}" class="form-control"   id="sequence" />
    @if ($errors->has('sequence'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('sequence') }}</strong>
        </span>
    @endif
</div>