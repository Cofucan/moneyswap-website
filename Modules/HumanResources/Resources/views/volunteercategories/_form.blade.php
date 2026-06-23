  <div class="form-group mb-3">
    <label for="investment_duration_id">Duration (month) </label>
    <select class="custom-select d-block w-100 select2" name="investment_duration_id" id="duration" required>
      @foreach($investmentdurations as $key => $duration)
          @if(old('investment_duration_id') == $key)
            <option value="{{$key}}" selected> {{$duration}}</option>
          @else
          <option value="{{$key}}"> {{ $duration}}</option>
          @endif
      @endforeach
      </select>
    @if ($errors->has('investment_duration_id'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('investment_duration_id') }}</strong>
        </span>
      @endif
  </div>
  <div class="form-group mb-3">
    <label for="interest_rate">Interest Rate (%) </label>
    <div class="input-group">
      <input type="number" name="interest_rate" value="{{old('interest_rate') }}" class="form-control{{ $errors->has('interest_rate') ? ' is-invalid' : '' }}" id="interest_rate" placeholder="" required>
       <div class="input-group-append">
        <div class="input-group-text">%</div>  
      </div>
    </div>
    @if ($errors->has('interest_rate'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('interest_rate') }}</strong>
        </span>
      @endif
  </div>
