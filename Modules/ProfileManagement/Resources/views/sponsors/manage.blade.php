@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-9">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    Screenings
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-3">
                <a href="{{ url('sponsors/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
            </div>
        </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Screenings </h3>	<small>The list below shows the sponsors create for various views</small>
	</div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table w-100" id="table">
                <thead>
                    <tr>
                        <th >#</th>
                
                        <th >Sponsor Title</th>
                        <th >Date </th>
                        <th >Duration </th>       
                        <th >Result Published On </th>              
                        <th >Admission AdmissionSchedule</th>
                        <th >Academic Term</th>
                      
                        <th  width="18%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sponsors as $sponsor)
                    <tr>
                        <td>{{$loop->iteration }}</td>
                        <td>{{$sponsor->label}}</td>
                        <td>{{$sponsor->screening_datetime}}</td>
                        <td>{{$sponsor->label}}</td>                
                        <td>{{$sponsor->result_available_at}}</td>
                        <td>{{$sponsor->AdmissionSchedule->label}}</td>
                        <td>{{$sponsor->admissionschedule->AcademicTerm->academic_term}}</td>                
                      
                        </td> 
                        <td>
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('sponsors.show', $sponsor->id) }}"><i class="fa fa-eye"></i></a>
                                </div>

                                <div class="col-md-4">
                                    <a class="btn btn-primary btn-sm" href="{{ route('sponsors.edit',$sponsor->id) }}"><i class="fa fa-edit"></i> </a>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('sponsors.destroy',$sponsor->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                    </form>
                                </div>

                            </div>
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
