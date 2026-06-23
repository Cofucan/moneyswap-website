@extends('layouts.admin')
@section('page_title', 'Member Requirements')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>                
        <li class="breadcrumb-item active" aria-current="page">Requirements  </li>
        <div class="ml-auto mr-0">
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new-requirement" href="#new-requirement"><i class="fa fa-plus"></i>  New Requirements</a>
                @include('profilemanagement::requirements._form')
        </div>
    </ol>
</nav>
 
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Requirements </h3>	
	</div>
  
</div>
    
    <div class="row">
        <div class="col-md-12 section-head">
            <div class="pull-left client-info ml-3">
                <span class="strong ">Requirements</span>
            </div>
            
        </div>
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>                           
                            <th>Requirement</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requirements as $requirement)
                            @include('profilemanagement::requirements._data')
                        @endforeach
                    </tbody>
                </table>
               
            </div>

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
