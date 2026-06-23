@extends('layouts.admin')
@section('page_title', 'Work Experience')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset ('css/board.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset ('css/login.css') }}"> --}}
<link rel="stylesheet" href="{{ asset ('css/resume.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">

@endpush
@section('content')

<section class="education">
  <div class="container">
    {{-- @include('partials.wizard-text') --}}
    <div class="row no-gutters mb-4" id="wizard">
      <div class="col-md-4 previous">
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
                {{--  <p>Fill the client & other information</p>  --}}
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-4 active">
        <div class="stages">
          <div class="row ">
            <div class="col-md-3">
              <div class="stage-number text-center">
                <h3>2</h3>
              </div>
            </div>
            <div class="col-md-9">
              <div class="stage-title">
                <h6 class="text-white">Enter Work History</h6>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-4">
        <div class="stages">
          <div class="row ">
            <div class="col-md-3">
              <div class="stage-number text-center">
                <h3>3</h3>
              </div>
            </div>
            <div class="col-md-9">
              <div class="stage-title">
                <h6>Enter Education Background</h6>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  <div class="container mt-2">

    <div class="row">

      <div class="col-md-8 order-md-1">
          {{-- @include('partials.alert') --}}

        <div class="card mt-3">
          <div class="card-header">
            <h4 class="mb-3">Work Experience </h4>
            <small> Starting with your most recent job role, Add your employment history to your resume.</small>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('employments.store') }}" id="CreateEmployment" enctype="multipart/form-data">
              {{csrf_field()}}
               <input type="hidden" name="profile_id" value="{{ Auth::user()->profile_id }}"  id="profile_id" />
                @include('humanresources::employments._form')

                  <hr class="mb-4">
                  <button class="btn btn-primary" type="submit" name="todo" value="addnew">Save & Add New </button>
                  <button class="btn btn-success" type="submit" name="todo" value="Continue">Save & Continue </button>
                  <a class="btn btn-danger" href="{{ route('educations.create') }}">Skip</a>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-4 order-md-2">
        <div class="card">
          <div class="card-header bg-primary">
            <h6 class="text-white">Existing Record </h6>
          </div>
          <div class="card-body bio-data">

            <ul class="timeline">
             @if ($employments->count() !== 0)
              @foreach($employments as $employment)
              <li class="ml-4">
                  <b>{{$employment->job_title}}</b>
                  <p><b> {{$employment->company}}; </b>
                     <small> {{$employment->location}}</small><br>
                      <b>Annual Salary:</b> {{$employment->annual_salary}}<br>
                  </p>
                <p>{{$employment->period}} </p>
              </li>
              @endforeach
              @else
              <p>None</p>
              @endif
            </ul>
          </div>
        </div>
      </div>
  </div>
</div>
</section>
{{--  --}}


@endsection
@push('scripts')

<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function(){
   $('.select2').select2();
});

CKEDITOR.replace("accomplishments",
      {
          height: 120,
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
<script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    jQuery(document).ready(function($) {

        $('input[name="started_at"]').daterangepicker({
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

        $('input[name="disengaged_at"]').daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            timePicker: false,
            locale: {
            format: 'YYYY-MM-DD'
            }        });

    });
</script> <script type="text/javascript">
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

@endpush
