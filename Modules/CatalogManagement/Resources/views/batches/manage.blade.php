@extends('layouts.admin')
@section('page_title', 'Arms' )
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Arms</li>
        <div class="ml-auto mr-0">
            <a href="{{ url('batches/create') }}" class="btn btn-sm btn-success">Add Arm to class</a>
        </div>
    </ol>
</nav>


<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Class Arms </h3>
	</div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                @foreach ($batches as $level => $batch_list)
                    <h5 class="bg-light">{{ $level }} - {{ $batch_list->count() }} Class(es) </h5>

                    <table class="table w-100">
                    <tbody>
                        @include('schoolmanagement::batches._tablehead')
                        @foreach($batch_list as $batch)
                        @include('schoolmanagement::batches._tabledata')
                        @endforeach
                    </tbody>
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
