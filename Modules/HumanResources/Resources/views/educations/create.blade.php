@extends('layouts.admin')
@section('page_title', 'Add Educational Qualification')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset ('css/board.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset ('css/login.css') }}"> --}}

<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/resume.css') }}">
<style>
  #qualification_loading{
  visibility:hidden;
  }

</style>
@endpush
@section('content')

<section class="education">
  <div class="container">
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
      <div class="col-md-4 previous">
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
      <div class="col-md-4 active">
        <div class="stages">
          <div class="row ">
            <div class="col-md-3">
              <div class="stage-number text-center">
                <h3>3</h3>
              </div>
            </div>
            <div class="col-md-9">
              <div class="stage-title">
                <h6 class="text-white">Academic Qualification</h6>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container mt-3">

    <div class="row">

      <div class="col-md-7  order-md-1">
        <div class="card">
          <div class="card-header">
            <h4 class="mb-3">Academic Qualification </h4>
            <small> Start with the most recent program and work backward.</small>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('educations.store') }}" id="CreateEducation" enctype="multipart/form-data">
              {{csrf_field()}}
               <input type="hidden" name="profile_id" value="{{ Auth::user()->profile_id }}"  id="profile_id" />

               @include('humanresources::educations._form')

                  <hr class="mb-4">
                  <button class="btn btn-primary" type="submit" name="todo" value="addnew">Save & Add New </button>
                  <button class="btn btn-success" type="submit" name="todo" value="Continue">Save & Continue </button>
                  @if($eduhistories->count() > 0)
                  <a class="btn btn-danger" href="{{ route('resumes.create') }}">Skip </a>
                  @endif
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-5  order-md-2">
        <div class="card">
          <div class="card-header bg-primary">
            <h6 class="text-white">Existing Academic Qualification </h6>
          </div>
          <div class="card-body bio-data">
            <ul class="timeline">
              @foreach($eduhistories as $education)
              <li class="ml-4">
                  <h6><b>{{$education->degree}}    </b></h6>
                  <p><b> {{$education->Organization->organization_name}}; </b> <br>
                    {{$education->period}} </p>
              </li>
          @endforeach
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
</script>
<script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    jQuery(document).ready(function($) {

        $('input[name="started_at"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            maxDate: moment(),
            timePicker: false,
            locale: {
            format: 'YYYY-MM-DD'
            }
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {

        $('input[name="completed_at"]').daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            timePicker: false,
            locale: {
            format: 'YYYY-MM-DD'
            }        });

    });
</script>


@endpush
