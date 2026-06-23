@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ url ('home')}}" class="s-text16">
                        <i class="fa fa-home"></i> Dashboard
                        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                    </a>

                    <span class="s-text17">
                        Core Values
                    </span>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('corevalues/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                    {{-- <a href="{{ url('corevalues/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a> --}}
                </div>
            </div>
        </div>
<div class="row">
  <div class="col-md-6 content_title">

     	<h3>  Core Values </h3>	</small>
	</div>
    
</div> 
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

        <table class="table" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Display image</th>
                    <th>Content</th>
                    <th>Display Order</th>
                    <th>Status</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($corevalues as $value)
                    @include('corevalues._data')
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
