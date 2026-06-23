@extends('layouts.admin')
@section('page_title', $employee->full_name)
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


                <div class="form-row mb-4">
                  <div class="col-md-5 ">
                    <label for="last_name" class="control-label">Full Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-user"></i></div>
                      </div>
                      <input type="text" name="last_name" value="{{ $employee->Person->last_name }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" placeholder="Last Name "required>
                    </div>
                    @if ($errors->has('last_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('last_name') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="col-md-4 ">
                    <label for="first_name" class="control-label">.</label>

                      <input type="text" name="first_name" value="{{ $employee->Person->first_name }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="First Name" required>

                      @if ($errors->has('first_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                      @endif
                  </div>

                  <div class="col-md-3 ">
                    <label for="middle_name" class="control-label">.</label>

                      <input type="text" name="middle_name" value="{{ $employee->Person->middle_name }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name" placeholder="Middle Name">

                      @if ($errors->has('middle_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('middle_name') }}</strong>
                      </span>
                      @endif
                  </div>
                </div>

                <div class="form-row mb-4">
                  <div class="col-md-6 ">
                    <label for="birthday" class="control-label">Date of birth</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                      <input type="text" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }} pull-right" name="birthday"  value="{{  $employee->Person->birthday }}">
                    </div>
                    @if ($errors->has('birthday'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('birthday') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="col-md-5 offset-md-1 ">
                    <label for="gender" class="control-label"> Gender </label><br>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="male" name="gender" type="radio" value="Male" class="custom-control-input" required>
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="Female" name="gender" type="radio" value="Female" class="custom-control-input" required>
                        <label class="custom-control-label" for="Female">Female</label>
                    </div>
                  </div>
                </div>

                 <div class="form-row">
                    <div class="col-md-6 form-group">
                      <label for="employment_type_id">EmployeeCategory</label>
                      <select class="custom-select{{ $errors->has('employment_type_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="employment_type_id" id="employment_type" required>
                        @foreach( $employeeTypes as $key => $employeeType)
                      @if( $employee->employment_type_id == $key)
                      <option value="{{$key}}" selected> {{$employeeType}}</option>
                          @else
                          <option value="{{$key}}"> {{$employeeType}}</option>
                          @endif
                      @endforeach
                      </select>
                      @if ($errors->has('employment_type_id'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('employment_type_id') }}</strong>
                          </span>
                      @endif
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="employee_number"> Employee Code </label>
                        <input type="text" name="employee_number" value="{{ $employee->employee_number }}" class="form-control" placeholder=""  id="employee_number" />
                        @if ($errors->has('employee_number'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('employee_number') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>



                  <div class="form-group mb-4">
                    <label class="control-label" for="marital_status">Marital Status</label><br>
                    @foreach($maritalStatus as $key => $value)
                      @if($employee->marital_status == $key)
                        <div class="custom-control custom-radio custom-control-inline">
                          <input id="{{ $key}}" name="marital_status" type="radio" value="{{ $value}}" class="custom-control-input" checked>
                          <label class="custom-control-label" for="{{ $key}}">{{ $value}}</label>
                        </div>
                        @else
                        <div class="custom-control custom-radio custom-control-inline">
                        <input id="{{ $key}}" name="marital_status" type="radio" value="{{ $value}}" class="custom-control-input" required>
                        <label class="custom-control-label" for="{{ $key}}">{{ $value}}</label>
                      </div>
                        @endif


                    @endforeach

                  </div>

                  <div class="form-row">
                    <div class="col-md-6 form-group">
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

                     <div class="col-md-6 form-group">
                        <label for="employee_status">Employment Status</label>
                        <select class="custom-select{{ $errors->has('employee_status') ? ' is-invalid' : '' }} d-block w-100 select2"  name="employee_status" id="employee_status" required>
                        @foreach($employeeStatus as $key => $status)
                          @if($employee->employee_status == $key)
                            <option value="{{$key}}" selected> {{$status}}</option>
                            @else
                            <option value="{{$key}}"> {{$status}}</option>
                          @endif
                          @endforeach

                        </select>
                        @if ($errors->has('employee_status'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('employee_status') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>


                    <div class="form-row">
                      <div class="col-md-6 form-group">
                        <label for="payee_number"> Payee Number </label>
                        <input type="text" name="payee_number" value="{{ $employee->payee_number }}" class="form-control"  id="payee_number" />
                        @if ($errors->has('payee_number'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('payee_number') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="col-md-6 form-group">
                        <label for="pension_number"> Pension Number </label>
                        <input type="text" name="pension_number" value="{{ $employee->pension_number }}" class="form-control"  id="pension_number" />
                        @if ($errors->has('pension_number'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('pension_number') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>

                      <div class="form-row">
                        <div class="col-md-6 mb-3 form-group">
                          <label class="control-label" for="hired_at">Date Employed</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                              <input type="text" class="form-control{{ $errors->has('hired_at') ? ' is-invalid' : '' }} pull-right" name="hired_at"  value="{{ $employee->hired_at }}">
                          </div>

                          @if ($errors->has('hired_at'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('hired_at') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                          <label class="control-label" for="date_left">Date Left</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                              <input type="text" class="form-control{{ $errors->has('date_left') ? ' is-invalid' : '' }} pull-right" name="date_left"  value="{{ null }}">
                          </div>

                          @if ($errors->has('date_left'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('date_left') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

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
                timePicker: false,
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
                timePicker: false,
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
