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
            <div class="col-md-4">
                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-department" href="#new-department"><i class="fa fa-plus"></i>Add New Department</a>          

                 @include('departments._form')
            </div>
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
                    <th > Description</th>
                    <th>Status</th>
                    <th  width="30%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$department->label}}</td>
                    <td>{{$department->overview}}</td>
                    <td>
                        @if ($department->published == true)
                        Published
                        @else
                        Not Publish                            
                        @endif
                    </td>
                    <td>
                        <div class="row no-gutters">
                            <div class="col-md-8">
                                @if($department->published == 1)                 
                                    <a class="btn btn-warning btn-sm" href="{{ url('departments/toggle', $department->id)}}"><i class="fa fa-power-off"></i></a>
                                    @else                        
                                    <a class="btn btn-success btn-sm" href="{{ url('departments/toggle', $department->id)}}"><i class="fa fa-play-circle-o"></i></a>
                                @endif
                                <a class="btn btn-secondary btn-sm" href="{{ route('departments.show', $department->id) }}">Details </a>
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-department{{$department->id}}" href="#edit{{$department->id}}"> Edit</a>
                                
                            </div>
                            <div class="col-md-1">
                                <form action="{{ route('departments.destroy',$department->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                </tr>
                @include('departments._formedit')
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
