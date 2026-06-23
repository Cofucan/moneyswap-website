@extends('layouts.admin')
@section('page_title', 'Enrol Employee')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
    .select2{
      w
    }
    #city_loading{
    visibility:hidden;
    }
    #state_loading{
        visibility:hidden;
    }
</style>
@endpush
@section('content')

<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('employees/manage')}}" class="s-text16">
          Employees
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Add Employee
        </span>
    </div>
<div class="row">

        <div class="col-md-9 order-md-1">
          <h4 class="mb-3">  Employee Enrolment Form </h4>
          <div class="form-card">
            <form method="POST" action="{{ route('employees.store') }}" id="CreateEmployee" enctype="multipart/form-data">
                  {{csrf_field()}}

                <h6 class="line2"> Personal Info</h6>

                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label" for="first Name"> Full Name </label>
                      <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="Last Name" required >
                      @if ($errors->has('last_name'))
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label" for="first"> . </label>
                      <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="First Name" required >
                      @if ($errors->has('first_name'))
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="marital_status"><strong>Marital Status</strong></label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="single" name="marital_status" type="radio" value="single" class="custom-control-input" >
                            <label class="custom-control-label" for="single">Single</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="married" name="marital_status" type="radio" value="married" class="custom-control-input">
                            <label class="custom-control-label" for="married">Married</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="divorced" name="marital_status" type="radio" value="divorced" class="custom-control-input">
                            <label class="custom-control-label" for="divorced">Divorced</label>
                        </div>
                        @if ($errors->has('marital_status'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('marital_status') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="gender" class="control-label m-r-10"> <strong> Gender  :</strong></label> <br>
                      <div class="custom-control custom-radio custom-control-inline" >
                          <input id="male" name="gender" type="radio" value="Male" class="custom-control-input mt-1" required>
                          <label class="custom-control-label" for="male">Male</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                          <input id="Female" name="gender" type="radio" value="Female" class="custom-control-input" required>
                          <label class="custom-control-label" for="Female">Female</label>
                      </div>
                      @if ($errors->has('gender'))
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('gender') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                </div>

                  <h6 class="line2 mt-3"> Contact Information</h6>

                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="telephone" class="label-control"> Contact Phone <span class="text-danger">*</span></label>
                        <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" placeholder="" value="{{ old('telephone') }}" required>

                        @if ($errors->has('telephone'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('telephone') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email" class="label-control"> Email</label>
                        <input id="email" type="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>


                  <h6 class="line2 mt-3"> Employment Information</h6>
                  {{-- <hr> --}}
                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="designation_id">Designation</label>
                      <select class="custom-select{{ $errors->has('designation_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="designation_id" id="designation_id" required>
                        @foreach($designations as $key => $designation)
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
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="employment_type_id">Employment type</label>
                      <select class="custom-select d-block w-100 select2{{ $errors->has('employment_type_id') ? ' is-invalid' : '' }}" name="employment_type_id">
                          @foreach($employmentTypes as $key => $employmentType)
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
                  </div>

                  <div class="form-row mb-3">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" for="hired_at">Date Hired</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="date" class="form-control{{ $errors->has('hired_at') ? ' is-invalid' : '' }} pull-right" name="hired_at"  value="{{old ('hired_at')}}">
                          </div>
                          @if ($errors->has('hired_at'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('hired_at') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>

                  </div>

                  <div class="form-group">
                  <h6 class="line2 mt-2">Work Address</h6>
                  <select class="custom-select d-block w-100 select2{{ $errors->has('campus_id') ? ' is-invalid' : '' }}" name="campus_id">
                      @foreach($portal->organization->campuses as $campus)

                        <option value="{{$campus->id}}"> {{$campus->address}}</option>

                      @endforeach
                  </select>
                  </div>
                  <div class="col-md-6">
                    <br>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="setup" id="setup" value="1">
                      <label class="form-check-label" for="setup">  Invite this employee to enter own details online </label>
                    </div>
                  </div>
              <hr class="mb-4">
                  <button class="btn btn-success btn-lg px-4" type="submit">Add</button>

            </form>
          </div>
        </div>
</div>
</div>


@endsection
@push('scripts')
<script>
  jQuery(document).ready(function($) {
   var readURL = function(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('.avatar').attr('src', e.target.result);
           }

           reader.readAsDataURL(input.files[0]);
       }
   }


   $(".file-upload").on('change', function(){
       readURL(this);
   });
});
</script>
  <script src="{{ asset('js/select2.full.min.js')}}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="hired_at"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                maxDate:moment(),
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                maxYear: 2000,
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });
    </script>
    <script type="text/javascript">
      $('#country').on('change',function(){
      var country = $(this).val();
      if(country){
        $.ajax({
          type:"GET",
          url:"{{url('countries/get-state-list')}}?country="+country,
          beforeSend: function()
          {
            $('#state_loading').css("visibility", "visible");
          },
          success:function(res){
            if(res){

              $("#state").empty();

              $('#state_loading').css("visibility", "hidden");

              $.each(res,function(key,value)
              {
                $("#state").append('<option value="'+key+'">'+value+'</option>'); });
              }else
              {
                $("#state").empty();
              }
            } });
      }else{
        $("#state").empty();
      }
    });
    </script>
    <script type="text/javascript">
        $('#sponsor_state').on('change',function(){
        var sponsor_state = $(this).val();
        if(sponsor_state){
        $.ajax({
        type:"GET",
        url:"{{url('states/get-city-list')}}?state="+sponsor_state,
        beforeSend: function()
        {
          $('#city_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){

            $("#sponsor_city").empty();

            $('#city_loading').css("visibility", "hidden");

            $.each(res,function(key,value)
            {
              $("#sponsor_city").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#sponsor_city").empty();
            }
          } });
        }else{
        $("#sponsor_city").empty();
        }
    });
  </script>
  <script type="text/javascript">
    $('#sponsor_state').on('change',function(){
    var sponsor_state = $(this).val();
    if(sponsor_state){
    $.ajax({
    type:"GET",
    url:"{{url('states/get-city-list')}}?state="+sponsor_state,
    beforeSend: function()
    {
      $('#city_loading').css("visibility", "visible");
    },
    success:function(res){
      if(res){

        $("#city").empty();
        $("#neighbourhood").empty();
        $('#city_loading').css("visibility", "hidden");

        $.each(res,function(key,value)
        {
          $("#city").append('<option value="'+key+'">'+value+'</option>'); });
        }else
        {
          $("#city").empty();
          $("#neighbourhood").empty();
        }
      } });
    }else{
    $("#city").empty();
    $("#neighbourhood").empty();
    }
    });
  </script>

      <script type="text/javascript">
        $('#city').on('change',function(){
            var city = $(this).val();
            if(city){
            $.ajax({
            type:"GET",
            url:"{{url('cities/get-neighbourhood-list')}}?city="+city,
            beforeSend: function()
            {
            $('#city_loading').css("visibility", "visible");
            },
            success:function(res){
            if(res){
                $("#neighbourhood").empty();

                $('#city_loading').css("visibility", "hidden");

                $.each(res,function(key,value)
                {
                $("#neighbourhood").append('<option value="'+key+'">'+value+'</option>'); });
                }else
                {
                $("#neighbourhood").empty();
                }
            } });
            }else{
            $("#neighbourhood").empty();
            }
        });
    </script>
    <script>

        jQuery(document).ready(function($){
            $(".toggle_container").hide();
            $("button.reveal").click(function(){
                $(this).toggleClass("active").next().slideToggle("fast");

                if ($.trim($(this).text()) === 'Hide') {
                    $(this).text('Add More Info');
                } else {
                    $(this).text('Hide');
                }

                return false;
            });
            $("a[href='" + window.location.hash + "']").parent(".reveal").click();
        });

    </script>

  <script>
    $(document).ready(function(){
        $('.select2').select2();
      });
  </script>

@endpush
