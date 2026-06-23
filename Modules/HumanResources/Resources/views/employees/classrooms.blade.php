@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text17">
               Classrooms
            </span>
        </div>
<div class="row mb-4">
  <div class="col-md-6 content_title">

         <h3> Classrooms </h3>
         <small>

         </small>
	</div>
    <div class="col-md-2">

    </div>
  <div class="col-md-4">
	  <div class="page_button">


	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table " id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Class Label </th>
                    <th >Academic Stream </th>
                    <th >ScoringScheme Level </th>
                    <th >Current Clients</th>
                    <th > Vacant Seats</th>
                    <th  width="12%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($employee->Classrooms as $classroom)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td> {{ $classroom->label }}</td>
                <td> {{ $classroom->Stream->stream_name }}</td>
                <td> {{ $classroom->Level->label }}</td>
                <td>{{$classroom->occupancy }}</td>
                <td> {{$classroom->capacity - $classroom->occupancy }} </td>


               <td>
                    <div class="row no-gutters">
                        <div class="col-md-9">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('classrooms.show', $classroom->id) }}"><i class="fa fa-eye"></i></a>

                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>
                </td>

            </tr>
            @endforeach
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
