@extends('layouts.admin')
@section('page_title', $batch->label .'Students')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<nav aria-label ="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
     
      <li class="breadcrumb-item"> <a href="{{ route ('batches.show', $batch)}}">  {{ $batch->label }}</a></li> 
             
      <li class="breadcrumb-item active" aria-current="page">Students</li>
      <div class="ml-auto mr-0">	        
         

      
      </div>
  </ol>
</nav>
    
<div class="row">
      
        <div class="col-md-10 order-md-1">
          <h4 class="mb-3"> {{ $batch->label }}'s Students</h4>
            <table class="table w-100 table-hover" id="table">
              <thead>
                  <tr>
                      <th ></th>
                      <th>Photographh</th>
                      <th>Admission No</th>
                      <th>Client Name</th>  
                      <th></th>
                  </tr>
              </thead>

              <tbody> 
                  @foreach($batch->enrolments as $enrolment)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td><img class="img-responsive thumbnail_img" src="{{  asset($enrolment->Client->Profile->passport) }}" width="40px" height="40px"/></td>
                      <td>{{$enrolment->enrol_code }}</td>
                      <td>{{$enrolment->Client->Profile->name}}</td>  
                      <td><a href="{{  route('enrolments.show', $enrolment->enrol_code) }}" class="btn btn-sm btn-primary px-3">View</a></td>
                  </tr>
                  @endforeach
              </tbody>
          </table>

        </div>
</div>


@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js')}}"></script>

@endpush
