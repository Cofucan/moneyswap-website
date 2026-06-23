@extends('layouts.admin')
@section('page_title', 'Resume Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 col-sm-6">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('resumes')}}" class="s-text16">
                    Resumes
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-4">

                <div class="page_button">
                    <a href="{{ url('resumes/create') }}" class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></a>
                    <a href="{{ url('resumes/upload') }}" class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></a>
                    <a href="{{ url('resumes/export') }}" class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></a>
                </div>
            </div>
        </div>
<div class="row">
    <div class="col-md-8 content_title">
     	<h4>Resume </h4>	<small>The list below shows the resumes create for various views</small>
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table w-100" id="table">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Client Name</th>
                        <th >Preferred Role</th>
                        <th >Qualification</th>
                        <th >Job Type</th>
                        <th >Experience </th>
                        <th >Updated </th>
                        <th >Status </th>
                        <th  width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resumes as $resume)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $resume->Profile->full_name }}  </td>
                        <td>{{ $resume->Designation->job_role }}</td>
                        <td>{{ $resume->Education->Qualification->qualification }} {{ $resume->Education->major }}</td>
                        <td>{{ $resume->EmploymentType->employment_type }}</td>
                        <td>{{ $resume->experience_years }}</td>
                        <td>{{ $resume->updated_at }}</td>
                        <td>{{$resume->status}}</td>

                        <td>
                            <div class="row no-gutters">
                                <div class="col-md-3 col-6">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('resumes.show', $resume->reference_code) }}"><i class="fa fa-eye"></i></a>
                                    {{-- <a class="btn btn-primary btn-sm" href="{{ route('resumes.edit',$resume->id) }}"><i class="fa fa-edit"></i> </a> --}}
                                </div>
                                <div class="col-md-3 col-6">

                                </div>
                                <div class="col-md-2 col-6">
                                    <form action="{{ route('resumes.destroy',$resume->reference_code) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
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
