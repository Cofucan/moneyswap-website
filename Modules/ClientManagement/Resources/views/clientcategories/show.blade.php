@extends('layouts.admin')
 @section('page_title', $clientcategory->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <div class="container-fluid">
        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"> <a href="{{ url('clientcategories') }}"> Client Types</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $clientcategory->label }}</li>
                <div class="ml-auto mr-0">

                </div>
            </ol>

        </nav>


    <div class="row details p-t-20">
        <div class="col-md-10 mb-4 content_title">
              <h4 class="mb-4">{{ $clientcategory->label}} </h4>
              <p><b>Clients Count:</b> {{ $clientcategory->Clients->count() }}</p>
              <p>{{$clientcategory->overview}}</p>
	    </div>
    </div>

    <div class="row">

            <div class="col-md-8 col-sm-12 col-xs-12 table-responsive">
                <h4 class="mt-2">Clients</h4>
                @foreach ($clients as $batch => $student_list)
                <h5 class="mb-2" style="background-color: #F7F7F7">{{ $batch }} - {{ $student_list->count() }} Clients </h5>
                <table class="table w-100 ">

                    <thead>
                        <th >#</th>
                        <th >Admission No. </th>
                        <th >Name</th>
                        <th >Class </th>
                        <th >Academic Group </th>
                        <th >Attendance Type </th>
                        <th  width="18%">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($student_list as $client)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$client->admission_no}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{ $client->grade_label}} </td>
                                <td>{{ $client->academic_group}} </td>
                                <td>{{ $client->attendance_type}} </td>
                                <td>
                                <a class="btn btn-secondary btn-sm" href="{{ route('clients.show', $client) }}">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
              </table>
                @endforeach

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
