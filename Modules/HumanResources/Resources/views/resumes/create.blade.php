@extends('layouts.admin')
@section('page_title', 'Create Resume')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset ('css/login.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset ('css/resume.css') }}"> --}}
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
    
    #city_loading{
    visibility:hidden;
    }
    #specialization_loading{
        visibility:hidden;
    }
    #skill_loading{
        visibility:hidden;
    }
</style>
@endpush
@section('content')

  <section class="education">
    {{-- <div class="container">
      @include('partials.wizard-text')
      <div class="row no-gutters mb-4" id="wizard">
       
        <div class="col-md-3 previous">
          <div class="stages">
            <div class="row ">
              <div class="col-md-3">
                <div class="stage-number text-center">
                  <h3>1</h3>
                </div>
              </div>
              <div class="col-md-9">
                <div class="stage-title">
                  <h6>Update Personal Details</h6>
                </div>
              </div>
            </div>
          </div>
  
        </div>
        <div class="col-md-3 previous">
          <div class="stages">
            <div class="row ">
              <div class="col-md-3">
                <div class="stage-number text-center">
                  <h3>2</h3>
                </div>
              </div>
              <div class="col-md-9">
                <div class="stage-title">
                  <h6>Enter Work History</h6>
                </div>
              </div>
            </div>
          </div>
  
        </div>
        <div class="col-md-3 previous">
          <div class="stages">
            <div class="row ">
              <div class="col-md-3">
                <div class="stage-number text-center">
                  <h3>3</h3>
                </div>
              </div>
              <div class="col-md-9">
                <div class="stage-title">
                  <h6 >Academic Qualification</h6>
                </div>
              </div>
            </div>
          </div>
  
        </div>
  
        <div class="col-md-3 active">
          <div class="stages">
            <div class="row ">
              <div class="col-md-3">
                <div class="stage-number text-center">
                  <h3>4</h3>
                </div>
              </div>
              <div class="col-md-9">
                <div class="stage-title">
                  <h6 class="text-white">Finalize your Resume</h6>
                </div>
              </div>
            </div>
          </div>
  
        </div>
       
      </div>
    </div> --}}

    
  <div class="container">
    
    <div class="row">

      <div class="col-md-8 order-md-1 mb-4 mt-4">
        @include('partials.alert')
        <div class="card">
          <div class="card-header">
            <h4 class="mb-3">Finalise Your Profile Creation</h4>
            <small>What are your employment interests?</small>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('resumes.store') }}" id="CreateResume">
              {{csrf_field()}}
              <input type="hidden" class="form-control" name="profile_id" value="{{ Auth::user()->profile_id }}">

              <div class="form-row">
                <div class="col-md-6 form-group">
                  <label for="designation_id"> Preferred Role</label>
                    <select class="custom-select d-block w-100 select2{{ $errors->has('designation_id') ? ' is-invalid' : '' }}"  name="designation_id" id="designation" required>
                      <option value="" selected> Select Preferred Job Role</option>
                      @foreach($designations as  $key=> $designation)
                        @if(old('designation_id') == $key)
                            <option value="{{$key}}" selected> {{$designation}}</option>
                            @else
                            <option value="{{$key}}"> {{$designation}}</option>
                        @endif
                      @endforeach
                    </select>
                    @if ($errors->has('designation_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('designation_id') }}</strong>
                        </span>
                    @endif                  
                </div>
                <div class="col-md-6 form-group">
                  <label for="employment_type_id"> Preferred Job Type</label>
                    <select class="custom-select d-block w-100 select2{{ $errors->has('employment_type_id') ? ' is-invalid' : '' }}"  name="employment_type_id" id="employment_type_id" required>
                      @foreach($employmentTypes as  $key=> $employmentType)
                        @if(old('employment_type_id') == $key)
                            <option value="{{$key}}" selected> {{$employmentType}}</option>
                            @else
                            <option value="{{$key}}"> {{$employmentType}}</option>
                        @endif
                      @endforeach
                    </select>
                    @if ($errors->has('employment_type_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('employment_type_id') }}</strong>
                        </span>
                    @endif                  
                </div>                                   
              </div>

              <div class="form-group">
                <label for="specialization"> Competence(s) </label> <span id="specialization_loading"><i class="fa fa-spinner fa-spin"></i></span>
                <select id="specializations" class="select2 form-control" name="specializations[]" multiple="multiple" data-live-search="true" >
                    <option value=""> Select Designation first</option>
                </select>
                
                @if ($errors->has('specializations'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('specializations') }}</strong>
                </span>
                @endif                       
              </div>    
           
              <div class="row">
                <div class="col-md-6 form-group">
                        <label for="city_id"> State you are willing to work</label>
                        <select name="state" class="custom-select d-block w-100 select2" id="state" required>
                            <option value="">Choose State </option>
                            @foreach($states as $key => $state)
                            <option value="{{$key}}"> {{$state}}</option>
                            @endforeach
                        </select> 
                        @if ($errors->has('state_id'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('state_id') }}</strong>
                                    </span>
                        @endif
                </div>            
                <div class="col-md-6 form-group">
                  <label for="city_id"> City you are willing to work</label>  <span id="city_loading"><i class="fa fa-spinner fa-spin"></i></span>
                  <select name="city_id" class="custom-select d-block w-100 select2" id="city" required>
                      <option value="">Choose Prefered City </option>
                  </select>
                    @if ($errors->has('city_id'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('city_id') }}</strong>
                      </span>
                    @endif
                </div>
              </div>   
                
              <div class="form-group">
                <label for="career_objective"> Career Objective <span class="required">*</span></label>
                <textarea name="career_objective" class="form-control {{ $errors->has('career_objective') ? ' is-invalid' : '' }}" rows="7" placeholder="Add your Career goal/objective">
                    {!! old('career_objective') !!}
                </textarea>
                @if ($errors->has('career_objective'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('career_objective') }}</strong>
                    </span>
                @endif
              </div>      
                 
    
              <hr class="mb-4">
              <button class="btn btn-success" type="submit">Submit </button>
    
            </form>
          </div>
        </div>
      </div>     
    </div>
  </div>
</section>
<section>
  
</section>


@endsection
@push('scripts')
  <script src="{{ asset('js/select2.full.min.js')}}"></script>
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
      CKEDITOR.replace("career_objective",
        {
            height: 100,
            // Define the toolbar groups as it is a more accessible solution.
         toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
          "name": "about",
          "groups": ["about"]
        }
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });
    </script>
  
    <script type="text/javascript">
      $('#state').on('change',function(){
      var state = $(this).val();
      if(state){
      $.ajax({
      type:"GET",
      url:"{{url('states/get-city-list')}}?state="+state,
      beforeSend: function()
      {
        $('#city_loading').css("visibility", "visible");
      },
      success:function(res){
        if(res){    
          $("#city").empty();    
          $('#city_loading').css("visibility", "hidden");    
          $.each(res,function(key,value)
          {
            $("#city").append('<option value="'+key+'">'+value+'</option>'); });
          }else
          {
            $("#city").empty();
          }
        } });
      }else{
      $("#city").empty();
      }
      });

    </script>   
  <script> 
    $(document).ready(function(){
        $('.select2').select2();
      });
  </script>
<script type="text/javascript">

    $('#designation').on('change',function()  {
    var designation = $(this).val();
    if(designation){
      $.ajax({
        type:"GET",
        url:"{{url('designations/get-specialization-list')}}?designation="+designation,
        beforeSend: function()
        {
          $('#specialization_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){
            $("#specializations").empty();
            $('#specialization_loading').css("visibility", "hidden");
            $.each(res,function(key,value)
            {
              $("#specializations").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#specializations").empty();
            }
          } });
    }else{
      $("#specializations").empty();
    }
  });
</script>
@endpush
