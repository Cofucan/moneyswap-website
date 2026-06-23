@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" href="{{asset('css/board.css') }}">
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text17">
               My Rooms
            </span>
        </div>

    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12 table-responsive">

        <table class="table " id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Class Label </th>
                    <th >Students Enrolled</th>
                    <th  width="33%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($employee->OfficialAppointments->count() > 0)
                @foreach($employee->OfficialAppointments as $official)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td> {{ $official->batch->label }}</td>
                        <td>{{$official->batch->Enrolments->count() }}</td>
                        <td>
                            <a class="btn btn-secondary btn-sm px-3 mb-2" href="{{ route('batches.show', $official->batch) }}">Details</a>
                            <a class="btn btn-primary btn-sm px-3 mb-2" href="{{ route('batch.enrolment',$official->batch) }}">Students</a>
                            <a class="btn btn-warning btn-sm px-3 mb-2" href="{{ route('attendances.report',$official->batch) }}">Attendance</a>
                        </td>

                    </tr>
                @endforeach
                @else
                No Room Assigned
                @endif
            </tbody>
        </table>
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
