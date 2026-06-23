    <div class="form-group mb-4">
      <label for="label"> Title</label>
      <input type="text" name="label" value="{{$sponsor->label}}" class="form-control {{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter sponsor title"  id="label"/>
      @if ($errors->has('label'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('label') }}</strong>
          </span>
      @endif
    </div>
    
    <div class="form-row mb-4">
        <div class="col-md-6 form-goup">
            <label for="relationship_id"> Sponsor Type</label>
            <select name="relationship_id" class="custom-select d-block w-100 select2" id="relationship_id" required>
                @foreach($screening_types as $key => $relationship_id)
                <option value="{{$key}}"> {{$relationship_id}}</option>
                @endforeach
            </select>
            @if ($errors->has('relationship_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('relationship_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-6 form-group">
            <label for="duration_minutes"> Duration</label>
            <div class="input-group">
            <input type="text" name="duration_minutes" value="{{ $sponsor->duration_minutes}}" class="form-control"  id="duration_minutes" />
                <div class="input-group-append">
                    <div class="input-group-text"> Minutes</div>
                </div>  
            </div>
            @if ($errors->has('duration_minutes'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('duration_minutes') }}</strong>
                </span>
            @endif
        </div>
       
    </div> 


    <div class="form-row">
      <div class="col-md-6 form-group">
        <label for="number"> Total Marks</label>
        <input type="text" name="total_marks" value="{{ $sponsor->total_marks}}" class="form-control" id="total_marks" />
          @if ($errors->has('total_marks'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('total_marks') }}</strong>
              </span>
          @endif
      </div>

      <div class="col-md-6 form-group">
        <label for="pass_mark"> Pass Marks</label>
        <input type="number" name="pass_mark" value="{{ $sponsor->pass_mark}}" class="form-control" id="pass_mark" />
          @if ($errors->has('pass_mark'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('pass_mark') }}</strong>
              </span>
          @endif
      </div>
    </div>


   
    <div class="form-row">
       <div class="col-md-6 mb-3 form-group">
          <label class="control-label" for="screening_datetime"> Date</label>
          <div class="input-group">
              <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
              <input type="text" class="form-control{{ $errors->has('screening_datetime') ? ' is-invalid' : '' }} pull-right" name="screening_datetime"  value="{{$sponsor->screening_datetime}}">
          </div>

          @if ($errors->has('screening_datetime'))
              <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('screening_datetime') }}</strong>
              </span>
          @endif
        </div>
        <div class="col-md-6 mb-3 form-group">
          <label class="control-label" for="result_available_at">Result Availability Date</label>
          <div class="input-group">
              <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
              <input type="text" class="form-control{{ $errors->has('result_available_at') ? ' is-invalid' : '' }} pull-right" name="result_available_at"  value="{{$sponsor->result_available_at}}">
          </div>

          @if ($errors->has('result_available_at'))
              <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('result_available_at') }}</strong>
              </span>
          @endif
        </div>
       
    </div>

        <div class="mb-3 form-group">
            <label for="gender" class="control-label"> Participating Sections </label><br>
            
                                
            @foreach($sections as $key => $program)
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name="sections[]" id="{{$key}}" value="{{$key}}" class="custom-control-input {{ $errors->has('program') ? ' is-invalid' : '' }}">
                    <label class="custom-control-label" for="{{$key}}">{{$program}}</label>
                </div>
                @endforeach
                @if ($errors->has('program'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('program') }}</strong>
                    </span>
                @endif
        </div>

    <div class="form-row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-danger reveal pull-right"><b>Add More Details</b></button>
            <div class="toggle_container" id="Description">

                <div class="form-group ">
                    <label for="details">Sponsor Details</label>
                    <textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" rows="3">
                        {{$sponsor->details}}
                    </textarea>
                    @if ($errors->has('details'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('details') }}</strong>
                        </span>
                    @endif
                </div>              

            </div>

        </div>
    </div>

