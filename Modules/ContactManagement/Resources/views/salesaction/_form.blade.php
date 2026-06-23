<div class="form-group">
    <label for="label">Label</label>
    <input type="text" name="label" value="{{old('label')}}" class="form-control" placeholder="E"  id="label" />
    @if ($errors->has('label'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('label') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="sales_cycle_id"> Cycle</label>
    <select class="custom-select w-100 select2" id="sales_cycle_id" name="sales_cycle_id">                
        @foreach($salescycles as $key => $cycle)
          @if(old('sales_cycle_id') == $key)
              <option value="{{  $key }}" selected>{{  $cycle }}</option>
          @else
              <option value="{{  $key }}">{{  $cycle }}</option>
          @endif
        @endforeach
    </select>
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