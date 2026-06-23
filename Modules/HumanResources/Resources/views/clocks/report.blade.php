@extends('layouts.admin')
@section('page_title', 'Clients')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Clients Register</li>
            <div class="ml-auto mr-0">

            </div>
        </ol>

    </nav>


    <div class="row">
        <div class="col-md-8 content_title">
            <h3> Active Clients </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
            <table class="table w-100 " id="table">
            <tbody>
            @foreach ($clients as $level => $student_list)
            <thead>
                <th colspan="6" style="background-color: #F7F7F7">{{ $student_list->count() }} Clients in {{ $level }} </th>
            </thead>
            <thead>
                <th >#</th>
                <th >Admission No. </th>
                <th >Name</th>
                <th >Class </th>
                <th >Academic Group </th>
                <th >Attendance Type </th>
                <th  width="18%">Actions</th>
            </thead>
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
            @endforeach
            </tbody>
          </table>
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
