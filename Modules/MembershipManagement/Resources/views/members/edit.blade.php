@extends('layouts.admin')
@section('page_title', $employee->Profile->full_name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

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

        <a href="{{ url ('employees/manage')}}" class="s-text16">
          Employees
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">

        </span>
    </div>
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">

        </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">   {{ $employee->Profile->full_name }} </h4>
            <form action="{{ route ('employees.update', $employee->id) }}" method="POST"  id="UpdateEmployee" enctype="multipart/form-data">
                {{csrf_field()}}
              @method('PUT')

                 <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="designation_id">Designation</label>
                        <select class="custom-select{{ $errors->has('designation_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="designation_id" id="designation_id" required>
                        @foreach($designations as $key => $designation)
                            @if($employee->designation_id == $key)
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
                            <label for="employment_type_id">Employment Type</label>
                            <select class="custom-select{{ $errors->has('employment_type_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="employment_type_id" id="employment_type" required>
                                @foreach( $employmentTypes as $key => $employmentType)
                                    @if( $employee->employment_type_id == $key)
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

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="hired_at">Date Employed</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="date" class="form-control{{ $errors->has('hired_at') ? ' is-invalid' : '' }} pull-right" name="hired_at"  value="{{ $employee->hired_at }}">
                            </div>

                            @if ($errors->has('hired_at'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hired_at') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Employment Status</label>
                            <select class="custom-select{{ $errors->has('status') ? ' is-invalid' : '' }} d-block w-100 select2"  name="status" id="status" required>
                            @foreach($employmentStatus as $key => $status)
                                @if($employee->status == $key)
                                <option value="{{$key}}" selected> {{$status}}</option>
                                @else
                                <option value="{{$key}}"> {{$status}}</option>
                                @endif
                                @endforeach

                            </select>
                            @if ($errors->has('status'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                  </div>


                    <div class="form-row">
                      {{-- <div class="col-md-6 mb-3 form-group">
                        <label class="control-label" for="date_left">Date Left</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          <input type="text" class="form-control{{ $errors->has('date_left') ? ' is-invalid' : '' }} pull-right" name="date_left"  value="">
                        </div>

                        @if ($errors->has('date_left'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date_left') }}</strong>
                            </span>
                        @endif
                      </div> --}}
                    </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
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
                format: 'YYYY/MM/DD'
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="date_left"]').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                showDropdowns: true,
                timePicker: false,
                maxDate:moment(),
                locale: {
                format: 'YYYY/MM/DD'
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                timePicker: false,
                locale: {
                format: 'YYYY/MM/DD'
                }
            });
        });
    </script>


  <script>
    $(document).ready(function(){
        $('.select2').select2();
      });
  </script>

@endpush
