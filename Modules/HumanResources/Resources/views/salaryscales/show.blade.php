@extends('layouts.admin')
 @section('page_title', $salaryscale->salary_scale)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')
  
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('salaryscales')}}" class="s-text16">
                    Salary Scales
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    {{ $salaryscale->salary_scale }}
                </span>
            </div>
        
            <div class="col-md-4 ">

                {{-- <a href="{{ url('salaryscales/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
                <a href="{{ url('salaryscales/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                <a class="btn btn-primary btn-sm" href="{{ route('salaryscales.edit',$salaryscale->id) }}"><i class="fa fa-pencil"></i> Edit</a> --}}
            
            </div>
        </div>
      <div class="row mt-3">
        <div class="col-md-6 content_title">
            <h4>  {{ $salaryscale->salary_scale }} </h4>	
        </div>
        
      </div>

      <div class="row mt-4">
          <div class="col-xs-6 col-sm-6 col-md-6">
              {{-- <div class="form-group">
                  <strong>Designation:</strong>
                 {{ $salaryscale->Designation->designation }}
              </div> --}}
              <div class="form-group">
                    <strong>Employee Type:</strong>
                   {{ $salaryscale->EmployeeType->employee_type }}
                </div>
                <div class="form-group">
                    <strong>Employment Status:</strong>
                   {{ $salaryscale->employee_status }}
                </div>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Qualification :</strong>
                    {{ $salaryscale->Qualification->label }} ({{ $salaryscale->Qualification->qualification }})
                </div>

                <div class="form-group">
                        <strong>Basic Pay :</strong>
                        {{$salaryscale->currency}} {{ number_format($salaryscale->basic_pay,2)}}
                    </div>
            </div>

          
          <div class="col-xs-12 col-sm-12 col-md-12">
            <hr>
              <div class="form-group">
                  <strong>Operational Description :</strong>
                  {!! $salaryscale->description !!}
              </div>
          </div>       

         
      </div>
   
    
@endsection