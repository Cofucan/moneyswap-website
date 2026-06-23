@extends('layouts.admin')
@section('page_title', 'Departments')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                Departments
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            {{-- <div class="col-md-4">
                <a href="{{ url('departments/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                 
            </div> --}}
        </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Departments </h3>
	</div>

</div>
    <div class="row mt-4">
      <div class="col-md-8 col-sm-12 col-xs-12">
           <div class="table-responsive">
            <table class="table w-100" id="table">
            <thead> 
                <tr>
                    <th width="8%">#</th>

                    <th >Department</th>
                    <th >Description</th>
                    
                </tr>
            </thead>
        <tbody>
            @foreach($departments as $department)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$department->label}}</td>
                <td>{{$department->overview}}</td>
                
            </tr>
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
