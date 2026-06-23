@extends('layouts.admin')
@section('page_title', $agent->Profile->full_name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<div class="container-fluid">
    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Agents </li>

            <div class="ml-auto mr-0">
                @if (Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11                                                                 || Auth::user()->Profile->role_id == 16)
                <a href="{{ url('agents/create') }}" class="btn btn-sm btn-success">Add Agent <i class="fa fa-plus"></i></a>
                <a href="{{ url('agents/upload') }}" class="btn btn-sm btn-warning">Bulk Upload  <i class="fa fa-arrow-down"></i></a>


                @endif
            </div>
        </ol>
    </nav>
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
          <h4 class="mb-3">   {{ $agent->Profile->full_name }} </h4>
            <form action="{{ route ('agents.update', $agent->id) }}" method="POST"  id="UpdateEmployee" enctype="multipart/form-data">
                {{csrf_field()}}
              @method('PUT')

                 <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="designation_id">Designation</label>
                        <select class="custom-select{{ $errors->has('designation_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="designation_id" id="designation_id" required>
                        @foreach($designations as $key => $designation)
                            @if($agent->designation_id == $key)
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
                            <label for="occupation_id">Employment Type</label>
                            <select class="custom-select{{ $errors->has('occupation_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="occupation_id" id="occupation" required>
                                @foreach( $occupations as $key => $occupation)
                                    @if( $agent->occupation_id == $key)
                                        <option value="{{$key}}" selected> {{$occupation}}</option>
                                    @else
                                    <option value="{{$key}}"> {{$occupation}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('occupation_id'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('occupation_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                  </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="annual_income">Date Employed</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="number" class="form-control{{ $errors->has('annual_income') ? ' is-invalid' : '' }} pull-right" name="annual_income"  value="{{ $agent->annual_income }}">
                            </div>

                            @if ($errors->has('annual_income'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('annual_income') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
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
            $('input[name="annual_income"]').daterangepicker({
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
