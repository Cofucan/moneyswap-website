@extends('layouts.admin')
@section('page_title', $sponsor->label)
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

            <a href="{{ url ('sponsors/manage')}}" class="s-text16">
                Screenings
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
               Edit {{ $sponsor->label }}
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
          <h4 class="mb-3"> Edit {{ $sponsor->label }}</h4>
            <form method="POST" action="{{ route('sponsors.update', $sponsor->id) }}" id="UpdateScreening" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                
                {{-- <div class="form-group mb-4">
                    <label for="profile_id"> Admission Schedule</label>
                    <select class="custom-select d-block w-100 select2" id="academic_term" name="profile_id">
                        <option value=""> Select Admission Schedule</option>
                        @foreach($admissionschedules as $admissionschedule)
                            @if($sponsor->profile_id == $admissionschedule->id)
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

                <div class="form-group">
                  <label for="label"> Title</label>
                  <input type="text" name="label" value="{{ $sponsor->label }}" class="form-control {{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter sponsor title"  id="label"/>
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
                            @if($sponsor->relationship_id == $key)
                            <option value="{{$key}}" selected> {{$relationship_id}}</option>
                            @else
                            <option value="{{$key}}" > {{$relationship_id}}</option>                          
                            @endif
                            @endforeach
                        </select>
                        @if ($errors->has('relationship_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('relationship_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="screening_mode"> Sponsor Mode</label>
                        <select name="screening_mode" class="custom-select d-block w-100 select2" id="program" required>
                            @foreach($screening_modes as $key => $screening_mode)
                            @if($sponsor->screening_mode == $key)
                            <option value="{{$key}}" selected> {{$screening_mode}}</option>
                            @else
                            <option value="{{$key}}"> {{$screening_mode}}</option>                        
                            @endif                           
                            @endforeach
                        </select>
                        @if ($errors->has('screening_mode'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('screening_mode') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>              


                <div class="form-row">
                  <div class="col-md-6 form-group">
                    <label for="total_marks"> Total Marks</label>
                    <input type="text" name="total_marks" value="{{ $sponsor->total_marks }}" class="form-control" id="total_marks" />
                      @if ($errors->has('total_marks'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('total_marks') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="pass_mark"> Pass Marks</label>
                    <input type="text" name="pass_mark" value="{{ $sponsor->pass_mark }}" class="form-control" id="pass_mark" />
                      @if ($errors->has('pass_mark'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('pass_mark') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>


                <div class="form-group ">
                    <label for="details">Sponsor Details</label>
                    <textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" rows="5">
                        {!!  $sponsor->details !!}
                    </textarea>
                    @if ($errors->has('details'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('details') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-row">
                   <div class="col-md-6 mb-3 form-group">
                      <label class="control-label" for="screening_datetime">Start Date</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                          <input type="text" class="form-control{{ $errors->has('screening_datetime') ? ' is-invalid' : '' }} pull-right" name="screening_datetime"  value="{{ $sponsor->screening_datetime}}">
                      </div>

                      @if ($errors->has('screening_datetime'))
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('screening_datetime') }}</strong>
                          </span>
                      @endif
                    </div>

                    <div class="col-md-6 mb-3 form-group">
                      <label class="control-label" for="result_available_at">End Date</label>
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

                    <div class="col-md-6 form-group">
                        <label for="label"> Duration</label>
                        <div class="input-group">
                        <input type="text" name="label" value="{{ $sponsor->label }}" class="form-control"  id="label" />
                            <div class="input-group-append">
                                <div class="input-group-text"> Minutes</div>
                            </div>  
                        </div>
                        @if ($errors->has('label'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                  </div>
                </div> --}}
                @include('sponsors._formedit')


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
            timePicker: true,
            locale: {
            format: 'YYYY-MM-DD hh:mm'
            }
        });
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
