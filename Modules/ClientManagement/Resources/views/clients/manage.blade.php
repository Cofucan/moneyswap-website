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
            <a href="{{ url('clients/new', Auth::user()->Profile->Agent->id)}}" class="btn btn-sm btn-secondary px-3 mb-2"> Add Orphan</a>
           </div>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 content_title">
            <h4 class="text-center text-uppercase"> Orphan Records </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">

                <table class="table w-100" id="table">
                    @include('clientmanagement::clients._typehead')
                    @foreach($clients as $client)
                    @include('clientmanagement::clients._typedata')
                    @endforeach
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

