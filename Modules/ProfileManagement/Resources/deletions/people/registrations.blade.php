@extends('layouts.admin')
@section('page_title', 'Users')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush

@section('content')
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 content_title">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    Users
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-4 col-sm-6">
              <!--   <a href="{{ url('people/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                <a href="{{ url('people/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
                <a href=""><button class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></button></a> -->
            </div>
	</div>

<div class="row">
    {{-- <div class="col-md-8 content_title">
     	<h3> Users </h3>
	</div> --}}

</div>
<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <h4 class="text-primary">{{ $chart1->options['chart_title'] }}</h4>

                {!! $chart1->renderHtml() !!}
        </div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>                    
                        <th>Gender </th>
                        <th>Last Login </th>
                        <th>Date Verified </th>
                        <th>Date Created </th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="user{{$user->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td><a href="{{ route('people.show', $user->Person->id) }}"> {{$user->full_name}} </a></td>
                        <td>{{$user->email}}</td>                     
                        
                        <td>{{$user->Person->gender}}</td>
                        <td>{{ $user->last_login_at}} </td>
                        <td>{{ $user->email_verified_at}} </td>
                        <td>{{ $user->created_at}} </td>
                         
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
    <script>
    jQuery(document).ready(function($) {
        $('#table').DataTable();
    } );
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
 @endpush
