<div class="form-group">
	<label for="organization_name">Employer Name <span class="required">*</span></label>
	<input type="text" name="organization_name" value="{{old('organization_name')}}" class="form-control{{ $errors->has('organization_name') ? ' is-invalid' : '' }}"  id="organization_name" required/>
	@if ($errors->has('organization_name'))
		<span class="invalid-feedback">
		<strong>{{ $errors->first('organization_name') }}</strong>
		</span>
	@endif
</div>

  <div class="form-row">
    <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="designation_id">Job Role </label>
        <select name="designation_id" class="custom-select d-block w-100 select2" id="designation_id" required>
          {{-- <option>Choose Type </option> --}}
            @foreach($designations as $key=> $designation)
            <option value="{{$key}}"> {{$designation}}</option>
            @endforeach
        </select> 
        @if ($errors->has('designation_id'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('designation_id') }}</strong>
          </span>
        @endif
      </div>
    </div>
  
    <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="employment_type_id"> Job Type </label>
        <select name="employment_type_id" class="custom-select d-block w-100 select2" id="employment_type_id" required>
          <option value="">Choose Employment Type </option>
          @foreach($employmentTypes as $employmentType)
            <option value="{{$employmentType->id}}"> {{$employmentType->label}}</option>
          @endforeach
        </select> 
        @if ($errors->has('employment_type_id'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('employment_type_id') }}</strong>
          </span>
        @endif
      </div>
    </div>
  </div>
  
  
<div class="form-row">
  <div class="col-md-6 col-sm-6">
    <div class="form-group">
      <label class="control-label" for="started_at"> Date Hired</label>
      <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
        <input type="date" class="form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }} pull-right" name="started_at"  value="{{old ('started_at')}}" required>
      </div>
      @if ($errors->has('started_at'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('started_at') }}</strong>
        </span>
      @endif
    </div>
  </div>

  <div class="col-md-6 col-sm-6">
    <div class="form-group">
      <label for="disengaged_at">End Date <small>(YYYY-MM-DD)<span class="text-muted"> Leave blank if still active</span></small></label>
      <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
        <input type="date" name="disengaged_at" value="{{old ('disengaged_at')}}" class="form-control{{ $errors->has('disengaged_at') ? ' is-invalid' : '' }}"  id="disengaged_at" />
      </div>                       
      @if ($errors->has('disengaged_at'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('disengaged_at') }}</strong>
        </span>
      @endif
    </div>
  </div>
</div>
  <div class="form-group">
    <label class="control-label" for="salary">Salary <small><span class="text-muted"> Only you and prospective employer can see this</span></small></label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">NGN</div>
        </div>
        <input type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }} pull-right" name="salary"  value="{{old ('salary')}}">
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
  
  @include('locationmanagement::addresses._locality')

<div class="form-group">
  <label class="control-label" for="accomplishments">Accomplishments <small><span class="text-muted">what value did you add to your employer</span></small></label>
  <textarea name="accomplishments" class="form-control {{ $errors->has('accomplishments') ? ' is-invalid' : '' }}" id="summernote">
    {{old('accomplishments')}}
  </textarea>
  @if ($errors->has('accomplishments'))
      <span class="invalid-feedback">
      <strong>{{ $errors->first('accomplishments') }}</strong>
      </span>
  @endif
</div>


@push('scripts')
<script>
  jQuery(document).ready(function($){
          $('input[name="salary"]').keyup(function(event) {

          // skip for arrow keys
          if(event.which >= 37 && event.which <= 40) return;

          // format number
          $(this).val(function(index, value) {
          return value
          .replace(/\D/g, "")
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
          ;
          });
      });
  });
</script>
@endpush
  


	
