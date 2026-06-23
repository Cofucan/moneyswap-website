<div class="form-group mb-3">
  <label for="investment_duration_id">Duration (month) </label>
 
    <input type="text" name="investment_duration_id" value="{{$investmentplan->duration}}" placeholder="{{ $investmentplan->duration }}"class="form-control{{ $errors->has('investment_duration_id') ? ' is-invalid' : '' }}" id="investment_duration_id" disabled>
    <input type="hidden" name="investment_duration_id" value="{{$investmentplan->investment_duration_id}}" >
  
  @if ($errors->has('investment_duration_id'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('investment_duration_id') }}</strong>
      </span>
    @endif
</div>
<div class="form-group mb-3">
  <label for="interest_rate">Interest Rate (%) </label>
  <div class="input-group">
    <input type="number" name="interest_rate" value="{{$investmentplan->interest_rate }}" class="form-control{{ $errors->has('interest_rate') ? ' is-invalid' : '' }}" id="interest_rate" placeholder="" required>
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
