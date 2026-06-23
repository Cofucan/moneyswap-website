@extends('layouts.admin')
@section('page_title', 'Admission Registrations')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-8 col-sm-6">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
               Applications
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>

            <span class="s-text17">
                Manage
            </span>
        </div>
        <div class="col-md-4">
        </div>
    </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3>  {{$admissionschedule->label ?? $status}} Applications</h3>
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
     <div class="table-responsive-md">
         @if($registrations->count() >0)
        <table class="table w-100 d-block mt-4" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Employee Code</th>
                    <th >Passport</th>
                    <th >Applicant Name</th>
                    <th >ScoringScheme</th>
                    <th >Client Type</th>
                    <th > Status</th>
                    <th >Academic Term </th>
                    <th >Last Updated</th>
                    <th  width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $employee)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$employee->registration_code }}</td>
                    <td><a  href="{{ route('registrations.show', $employee->id) }}"><img class="img-responsive thumbnail_img" src="{{  asset($employee->avatar) }}" width="60px" height="60px"/>
                      </a>
                    </td>
                    <td>{{$employee->Person->candidate_name}}</td>
                    <td>{{$employee->Level->label }}</td>
                    <td>{{$employee->ClientCategory->student_type }}</td>
                    <td>{{$employee->status }}</td>
                    <td>{{$employee->AdmissionSchedule->AcademicTerm->academic_term }}</td>
                    <td>{{$employee->updated_at }}</td>
                    <td>
                       @include('registrations._actions')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p> You have not applied for admission on this platform </p>
        @endif
</div>
</div>
</div>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
