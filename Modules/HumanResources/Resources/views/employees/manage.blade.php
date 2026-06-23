@extends('layouts.admin')
@section('page_title', 'Employee Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Staff</li>
                <div class="ml-auto mr-0">
                @if (Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16)
                 <a href="{{ url('employees/create') }}" class="btn btn-sm btn-success">Add Employee </a>
                @endif
                {{-- @if ($formerstaff->count() > 0)
                <a href="{{ url('employees/past') }}" class="btn btn-sm btn-danger btn-block">Former Employees</a>
                @endif --}}
                </div>
            </ol>
        </nav>

<div class="row mt-4">
    <div class="col-md-10 col-6 content_title">
     	<h4>Team Member </h4>	<small></small>
	</div>
    <div class="col-md-2 col-6">

    </div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table w-100" id="table">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Employee Name</th>
                        <th >Position</th>
                        <th >Status </th>
                        <th  width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $employee->Profile->full_name }}  </td>
                        <td>{{ $employee->position }}</td>
                        <td>{{$employee->status}}</td>

                        <td>
                            <div class="row no-gutters">
                                <div class="col-md-9">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('employees.show', $employee) }}">Details</a>
                                    @if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16 )
                                        <a class="btn btn-primary btn-sm" href="{{ route('employees.edit',$employee) }}">Edit </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#relieve{{ $employee->id }}" href="#relieve{{ $employee->id }}" data-toggle="tooltip" data-placement="top" title="Click to Relieve Staff">
                                            Relieve
                                        </a>
                                    @endif
                                </div>
                                @if((Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3) )
                                <div class="col-md-3">
                                    <form action="{{ route('employees.destroy',$employee) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @include('humanresources::employees._relieve')
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
