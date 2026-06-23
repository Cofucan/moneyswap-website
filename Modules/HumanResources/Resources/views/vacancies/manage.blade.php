@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 col-sm-7">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                Vacancy
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-4">
                @if (Auth::user()->profile->role_id == 11 || Auth::user()->profile->role_id == 16)
                <a href="{{ url('vacancies/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                @endif
            </div>
        </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Vacancies </h3>	<small>The list below shows the vacancies created</small>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="table-responsive"> -->
            <table class="table w-100" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Job Title</th>
                    <th >Employment Type</th>
                    {{-- <th >Contract Term</th> --}}
                    <th >Academic Term </th>
                    <th  width="15%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($vacancies as $vacancy)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$vacancy->Designation->job_role}}</td>
                <td>{{$vacancy->EmploymentType->employment_type }}</td>
                {{-- <td>{{$vacancy->contract_type }}</td> --}}
                <td>{{$vacancy->AcademicTerm->academic_term }}</td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-3 col-4">
                            <a class="btn btn-secondary btn-sm" href="{{ route('vacancies.show', $vacancy->id) }}"><i class="fa fa-eye"></i></a>
                        </div>
                        @if (($vacancy->status == 'Draft' || $vacancy->status == 'Rejected') && $vacancy->user_id == Auth::id() )
                            <div class="col-md-3 col-4">
                                    <a class="btn btn-primary btn-sm" href="{{ route('vacancies.edit',$vacancy->id) }}"><i class="fa fa-edit"></i></a>


                            </div>
                            <div class="col-md-1 col-4">
                                <form action="{{ route('vacancies.destroy',$vacancy->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>
            </tr>
            @endforeach
            </tbody>
            </table>
<!-- </div> -->
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
