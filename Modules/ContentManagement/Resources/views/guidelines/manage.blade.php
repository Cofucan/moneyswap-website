@extends('layouts.admin')
@section('page_title', 'Guideline Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-8 col-sm-6">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
                   Policy
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>

            <span class="s-text17">
                Manage
            </span>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="{{ url('guidelines/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>

        </div>
	</div>
<div class="row">
    <div class="col-md-8 label">
     	<h3> School Policies </h3>
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-12">

        <table class="table" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Policy Title</th>
                    <th > Last Updated</th>
                    <th > Status</th>
                    <th  width="20%">Actions</th>
                </tr>
            </thead>
            <tbody >
                @foreach($guidelines as $guideline)

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
