<div class="form-group">
  <label class="control-label" for="salary">Salary</label>
  <div class="input-group">
      <div class="input-group-prepend">
          <div class="input-group-text">NGN</div>
      </div>
      <input type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }} pull-right" name="salary"  value="{{$employment->salary}}">
      <div class="input-group-append">
          <div class="input-group-text">Monthly</div>
      </div>
  </div>

  @if ($errors->has('salary'))
      <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('salary') }}</strong>
      </span>
  @endif    
</div>

  <div class="form-row">
    <div class="col-md-6 mb-3 form-group">
        <label class="control-label" for="started_at">Start Date</label>
        <div class="input-group">
          <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
          <input type="date" class="form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }} pull-right" name="started_at"  value="{{$employment->started_at}}">
        </div>
  
      @if ($errors->has('started_at'))
          <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('started_at') }}</strong>
          </span>
      @endif
    </div>
  
    <div class="col-md-6 form-group">
      <label for="disengaged_at">End Date</label>
      <div class="input-group">
          <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
          <input type="date" name="disengaged_at" value="{{$employment->disengaged_at}}" class="form-control{{ $errors->has('disengaged_at') ? ' is-invalid' : '' }}"  id="disengaged_at" />
      </div>                       
     
    </div>
  </div>
  <div class="form-group">
    <label class="control-label" for="accomplishments">Accomplishments</label>
    <textarea name="accomplishments" class="form-control {{ $errors->has('accomplishments') ? ' is-invalid' : '' }}" rows="5">{!! $employment->accomplishments !!}</textarea>
    @if ($errors->has('accomplishments'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('accomplishments') }}</strong>
      </span>
    @endif
  </div>