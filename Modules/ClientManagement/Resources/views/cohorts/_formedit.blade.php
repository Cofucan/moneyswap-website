<div class="form-group">
    <label class="control-label" for="academic_term_id">Academic Term</label>
   <select name="academic_term_id" class="custom-select d-block w-100 select2" id="academicterm" required>
   @foreach($academicterms as $key => $academicterm)
   @if($cohort->academic_term_id == $key)
    <option value="{{$key}}" selected> {{$academicterm}}</option>
   @else
    <option value="{{$key}}"> {{$academicterm}}</option>
   @endif
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
               @foreach($outlets as $key => $outlet)
               @if($cohort->outlet_id == $key)
               <option value="{{$key}}" selected> {{$outlet}}</option>
                @else
                <option value="{{$key}}"> {{$outlet}}</option>
                @endif               
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
           @if($cohort->batch_id == $key)
            <option value="{{$key}}" selected> {{$batch}}</option> 
            @else
            <option value="{{$key}}"> {{$batch}}</option>
            @endif          
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