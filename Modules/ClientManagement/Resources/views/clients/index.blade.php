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
            <li class="breadcrumb-item"> <a href="{{ url('cohorts/manage') }}"> <i class="fa fa-list"></i> Clients Groups</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Clients Register</li>
            <div class="ml-auto mr-0">
            <a href="{{ url('clients/create')}}" class="btn btn-sm btn-success px-3 mb-2"> Add Client</a>
            <a href="{{ url('clients/upload')}}" class="btn btn-sm btn-primary px-3 mb-2"> Bulk Upload</a>

           @include('ClientManagement::clients._grademodal')
            <a href="{{ url('clientcategories') }}" class="btn btn-sm btn-danger px-3 mb-2"> Client Stats</a>
            </div>
        </ol>

    </nav>

    <div class="row">
        <div class="col-md-8 content_title">
            <h3> Active Clients </h3>
        </div>
    </div>

    @include('ClientManagement::clients.metrics')
    <div class="row">
	<div class="col-md-12">
		@foreach ($outlets as $outlet)
			@include('organizationmanagement::outlets._metrics')
		@endforeach
	</div>
	<div class="col-md-9">
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
