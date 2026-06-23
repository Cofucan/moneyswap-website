@extends('layouts.admin')
@section('page_title', 'Active Clients')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('cohorts/manage') }}"> <i class="fa fa-list"></i> Clients Groups</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('clients') }}"> <i class="fa fa-list"></i> Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Register</li>
           <div class="ml-auto mr-0">

           </div>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 content_title">
            <h4 class="text-center text-uppercase"> Active Clients </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
            @foreach ($clients as $clientcategory => $student_list)
                <h5 class="bg-light">{{ $student_list->count() }}  {{ $clientcategory }} Client(s)</h5>

                <table class="table w-100" id="table">
                    @include('ClientManagement::clients._typehead')
                    @foreach($student_list as $client)
                    @include('ClientManagement::clients._typedata')
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

