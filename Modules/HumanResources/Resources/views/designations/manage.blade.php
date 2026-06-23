@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text17">
               Designations
            </span>
        </div>
<div class="row">
  <div class="col-md-6 content_title">

         <h3> Designations </h3>
         <small>

         </small>
	</div>
    <div class="col-md-3">

    </div>
  <div class="col-md-3">
	  <div class="page_button">
        <a href="{{ url('designations/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('designations/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th> Designation </th>
                    <th>Profile </th>
                    <th>Role </th>
                    <th width="18%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($designations as $designation)
            <tr>
                <td>{{$designation->id}}</td>

                <td>{{$designation->designation}} </td>
                <td>{{$designation->RoleCategory->profile_type}} </td>
                <td>{{$designation->Role->label}} </td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-9">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('designations.show', $designation->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{ route('designations.edit',$designation->id) }}"><i class="fa fa-edit"></i> </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('designations.destroy',$designation->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                </td>


            </tr>
            @endforeach
            </tbody>
            </table>
</div>
</div>

@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
