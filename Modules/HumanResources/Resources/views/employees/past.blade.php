@extends('layouts.admin')
@section('page_title', 'Employee Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 col-sm-6">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>
                @if (Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16)
                <a href="{{ url ('employees/manage')}}" class="s-text16">
                    Employees
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>
                @else()
                <a href="{{ url ('employees')}}" class="s-text16">
                    Staff Directory
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>
                @endif

                <span class="s-text17">
                    Former Staff
                </span>
            </div>
            <div class="col-md-4">

            </div>
        </div>

<div class="row">
    <div class="col-md-9 col-6 content_title">
     	<h4>Former Staff </h4>	<small></small>
	</div>
    <div class="col-md-3 col-6">

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
                        <th >Employee Code</th>
                        <th >Designation</th>
                        <!-- <th >Qualification</th> -->
                        <th >Years in Service </th>
                        <th >Status </th>
                        <th  width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $employee->Profile->full_name ?? 'N/A' }}  </td>
                        <td>{{ $employee->employee_code }}</td>
                        <td>{{ $employee->Designation->job_role }}</td>
                        {{-- <td>{{ $employee->qualification}}</td> --}}
                        <td>{{ $employee->years_in_service }}</td>
                        <td>{{$employee->status}}</td>

                        <td>

                            <div class="row no-gutters">
                                <div class="col-md-7">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('employees.show', $employee->id) }}">Details</a>
                                </div>
                                 @if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11  )
                                <div class="col-md-3">
                                    <form action="{{ route('employees.destroy',$employee->id) }}" method="post"
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
