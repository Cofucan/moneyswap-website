@extends('layouts.admin')
@section('page_title', $instruction->headline)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link href="{{ asset ('css/admission.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
  <style>
        #state_loading{
        visibility:hidden;
        }
        #city_loading{
        visibility:hidden;
        }
        #neighbourhood_loading{
        visibility:hidden;
        }
        #group_loading{
            visibility:hidden;
            }
  .myDiv{
      display:none;
  }
</style>

@endpush


@section('content')


<nav aria-label ="breadcrumb mb-3">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item"> <a href="{{ url('studdents/manage') }}"> <i class="fa fa-list"></i> Clients</a></li>
      @if (isset($cohort))
      <li class="breadcrumb-item"><a href="{{ route ('cohorts.show', $cohort)}}"> {{ $cohort->label }}</a></li>
      @endif

      <li class="breadcrumb-item active" aria-current="page">  Add Client</li>

      <div class="ml-auto mr-0">
        <a href="{{ url('clients/upload')}}" class="btn btn-sm btn-secondary px-3 mb-2"> Bulk Upload</a>

      </div>
  </ol>
</nav>
   <!--==========================
      Intro Section
    ============================-->




          <div class="row">
          <div class="col-md-10">
          <h3>{{$instruction->headline}}</h3>
            {!!$instruction->body!!}
            <hr>

              <form method="POST" action="{{ route('clients.store') }}" id="ClientForm" enctype="multipart/form-data">
                  {{csrf_field()}}
                @include('clientmanagement::clients._form')
                <h6 class="line"> Enrolment Details</h6>
                  {{-- <hr> --}}
                  <div class="form-row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="cause_id">Support Category</label>
                            <select name="cause_id" class="custom-select select2" id="cause" required>
                                @foreach($causes as $key => $cause)
                                <option value="{{$key}}"> {{$cause}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('cause_id'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('cause_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="program_id">Program</label>
                            <select name="program_id" class="custom-select select2" id="program" required>
                                <option>Choose program </option>
                                @foreach($programs as $key => $program)
                                <option value="{{$key}}"> {{$program}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('program_id'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('program_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="batch">Class </label><span id="live_loading"><i class="fa fa-spinner fa-spin"></i> Fetching data, pls wait!</span>
                            <select name="batch_id" class="custom-select d-block w-100 select2 {{ $errors->has('batch_id') ? ' is-invalid' : '' }}" id="batch" required>
                            </select>
                        </div>
                    </div>

                  </div>

                  <div class="form-row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="client_category_id"> Attendance Type </label>
                      <select name="client_category_id" class="custom-select d-block w-100 select2" id="student_type" required>
                          @foreach($clientcategories as $key => $student_type)
                              <option value="{{$key}}"> {{$student_type}}</option>
                          @endforeach
                      </select>
                      @if ($errors->has('client_category_id'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('client_category_id') }}</strong>
                                  </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="admission_no">Admission Number</label>
                        <input id="admission_no" type="number" value="{{ old ('admission_no')}}" class="form-control{{ $errors->has('admission_no') ? ' is-invalid' : '' }}" name="admission_no">
                        @if ($errors->has('admission_no'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('admission_no') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>


                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="transaction_method_id">Preferred Payment Method </label>
                            <select name="transaction_method_id" class="custom-select d-block w-100 select2 {{ $errors->has('transaction_method_id') ? ' is-invalid' : '' }}" id="transactionmethod" required>
                              <option>Choose Payment Method </option>
                                @foreach($transactionmethods as $key => $transactionmethod)
                                <option value="{{$key}}"> {{$transactionmethod}}</option>
                                @endforeach
                            </select>
                        </div>
                          @if ($errors->has('transaction_method_id'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('transaction_method_id') }}</strong>
                              </span>
                          @endif
                    </div>

                  </div>

                <hr>
                @if(auth::user()->profile->role_id == 9)
                <input id="agent_id" type="hidden" name="agent_id" value="{{ Auth::user()->profile->referral_id }}">
                @else
                <span class="span">Sponsor Details</span>
                <hr>
                <div class="form-row mb-2">

                    <div class="col-md-12 mb-3 form-group">
                      <div class="custom-control custom-radio custom-control-inline">
                          <input id="create" name="profile" type="radio" value="Create" class="custom-control-input" required>
                          <label class="custom-control-label" for="create">Add to existing Sponsor</label>
                      </div>

                      <div class="custom-control custom-radio custom-control-inline">
                              <input id="new" name="profile" type="radio" value="New" class="custom-control-input" required>
                              <label class="custom-control-label" for="new">Create New Sponsor Profile </label>
                      </div>
                    <div class="mb-3 form-group">
                        <select name="relationship_id" class="custom-select d-block w-100 select2" id="relationship">
                            <option value="">Relationship with Orphan</option>
                            @foreach($relationships as $key => $relationship)
                            @if(old('relationship_id') == $key)
                            <option value="{{$key}}" selected> {{$relationship}}</option>
                            @else
                            <option value="{{$key}}"> {{$relationship}}</option>
                            @endif
                        @endforeach
                        </select>
                        @if ($errors->has('relationship_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('relationship_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>
                  <div class="col-md-12">
                      <div id="showCreate" class="myDiv">
                          <div class="form-group">
                            <label for="agent_id">Sponsor Name</label>
                            <select name="agent_id" class="custom-select d-block w-100 select2 {{ $errors->has('agent_id') ? ' is-invalid' : '' }}" id="agent">
                              <option value=""> Select Sponsor</option>
                              @foreach($agents as $agent)
                              <option value="{{$agent->id}}"> {{$agent->representative}}</option>
                              @endforeach
                          </select>
                          </div>
                      </div>
                      <div id="showNew" class="myDiv">
                        <div class="mb-3 form-row">
                          <div class="col-md-6 input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-user-o"></i></div>
                              </div>
                              <input id="agent_lastname" value="{{ old('agent_lastname') }}" type="text" class="form-control{{ $errors->has('agent_lastname') ? ' is-invalid' : '' }}" name="agent_lastname" placeholder="Sponsor Last Name">

                                  @if ($errors->has('agent_lastname'))
                                  <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('agent_lastname') }}</strong>
                                  </span>
                              @endif
                          </div>

                          <div class="col-md-6 input-group">
                            <input id="agent_firstname" value="{{ old('agent_firstname') }}" type="text" class="form-control{{ $errors->has('agent_firstname') ? ' is-invalid' : '' }}" name="agent_firstname" placeholder="Agent First Name">

                            @if ($errors->has('agent_firstname'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('agent_firstname') }}</strong>
                            </span>
                            @endif
                        </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-6 mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                                </div>
                                <input id="email" type="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="E-mail Address">
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="col-md-6 mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                </div>
                                <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" placeholder="Telephone" value="{{ old('telephone') }}">
                            </div>
                            @if ($errors->has('telephone'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('telephone') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
                @include('locationmanagement::addresses._locality')
                @endif

                  <hr class="mb-4">
                <div class="row">
                    <div class="col-md-3 offset-md-9">
                        <button class="btn btn-primary btn-block" type="submit">Add Client</button>
                    </div>
                </div>
              </form>
          </div>



  @endsection
  @push('scripts')
  <script>
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide Address') {
                $(this).text('Add Address');
            } else {
                $(this).text('Hide Address');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });
</script>
  <script>
    jQuery(document).ready(function($){
        $('input[type="radio"]').click(function(){
        var demovalue = $(this).val();
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
        });
     });
 </script>

  <script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
         jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2003,
                maxYear: 2011

            });
        });
    </script>
    <script>
         jQuery(document).ready(function($) {
            $('input[name="entrance_exam_date"]').daterangepicker({
                singleDatePicker: true,
                locale: {
                format: 'YYYY/M/DD'
                }
            });
        });
    </script>
  <script src="{{ asset('plugins/anime/anime.js')}}"></script>
  <script src="{{ asset('js/select2.full.min.js')}}"></script>

  <script type="text/javascript">
    $('#program').on('change',function(){
      var program = $(this).val();
      if(program){
        $.ajax({
          type:"GET",
          url:"{{url('programs/get-batch-lists')}}?program="+program,
          beforeSend: function()
          {
            $('#live_loading').css("visibility", "visible");
          },
          success:function(res){
            if(res){

              $("#batch").empty();
              $('#live_loading').css("visibility", "hidden");
              $.each(res,function(key,value)
              {
                $("#batch").append('<option value="'+key+'">'+value+'</option>'); });
              }else
              {
                $("#batch").empty();
              }
            } });
      }else{
        $("#batch").empty();
      }
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
     <script type="text/javascript">

    </script>

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

@endpush
