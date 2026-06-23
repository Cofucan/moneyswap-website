@extends('layouts.admin')
@section('page_title', 'Agent Schedule')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">

@endpush
@section('content')
<div class="container-fluid">

          <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <a href="{{ url ('agents/manage')}}" class="s-text16">
                Screenings
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Setup Agent
            </span>
        </div>
<div class="row">
  <!-- <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Existing Sections</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">
            <ul>
                <li><a href="{{url ('/')}}">First Term</a></li>
            </ul>
        </div> -->

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Setup Agent</h4>
            <form method="POST" action="{{ route('agents.store') }}" id="CreateScreening" >
                {{csrf_field()}}


                <div class="form-group mb-4">
                    <label for="profile_id"> Admission Schedule</label>
                    <select class="custom-select d-block w-100 select2" id="academic_term" name="profile_id">
                        <option value=""> Select Admission Schedule</option>
                        @foreach($admissionschedules as $admissionschedule)
                            @if(old('profile_id') == $admissionschedule->id)
                            <option value="{{$admissionschedule->id}}" selected> {{ $admissionschedule->AcademicTerm->academic_term }} ({{$admissionschedule->available_at }})</option>
                                @else
                            <option value="{{$admissionschedule->id}}"> {{ $admissionschedule->AcademicTerm->academic_term }} ({{$admissionschedule->available_at }})</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('profile_id'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('profile_id') }}</strong>
                        </span>
                      @endif

                </div>
                @include('agents._form')




                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Cancel</button>

            </form>
        </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
         jQuery(document).ready(function($) {
            $('input[name="screening_datetime"]').daterangepicker({
                singleDatePicker: true,
                minDate:moment().add(14, 'day'),
                timePicker: true,
                locale: {
                format: 'YYYY-MM-DD hh:mm'
                }
            });
        });
    </script>
    <script>
         jQuery(document).ready(function($) {
            $('input[name="result_available_at"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                minDate:moment().add(14, 'day'),
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });
        jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide') {
                $(this).text('Add More');
            } else {
                $(this).text('Hide');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });
    </script>
<script>
    CKEDITOR.replace("details",
        {
            height: 120
        });
</script>
  <script src="{{ asset('js/select2.full.min.js')}}"></script>
  <script>
     jQuery(document).ready(function($) {
        $('.select2').select2();
      });
  </script>
@endpush
