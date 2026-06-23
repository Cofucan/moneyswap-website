@extends('layouts.admin')
@section('page_title', $status. ' Clients')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('cohorts/manage') }}"> <i class="fa fa-list"></i> Clients Groups</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('clients') }}">Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">  {{ $status }}</li>
           <div class="ml-auto mr-0">
            @if($status == "Discontinued")
                @include('ClientManagement::clients._bulkactivate')
            @endif
           </div>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 content_title">
            <h4 class="text-center text-uppercase"> {{$status}} Clients </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
            @foreach ($clients as $level => $student_list)

                <h5 class="bg-light">{{ $student_list->count() }} Client(s) In {{ $level }} </h5>

                <table class="table w-100 ">
                    @include('ClientManagement::clients._minihead')
                    @foreach($student_list as $client)
                    @include('ClientManagement::clients._minidata')
                    @endforeach
                </table>
            @endforeach
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
