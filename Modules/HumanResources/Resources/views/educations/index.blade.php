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
               Educations
            </span>
        </div>
<div class="row">
  <div class="col-md-6 content_title">

         <h3> Educations </h3>
         <small>

         </small>
	</div>
    <div class="col-md-3">

    </div>
  <div class="col-md-3">
	  <div class="page_button">
        <a href="{{ url('educations/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('educations/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
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
                    <th>Full Name </th>
                    <th>School </th>
                    <th>Program </th>
                    <th>Qualification </th>
                    <th>Date </th>
                    
                    <th width="18%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($educations as $education)
            <tr>
                <td>{{$education->id}}</td>

                <td>{{$education->full_name}} </td>
                <td>{{$education->Organization->organization_name }}</td>
                <td>{{$education->Program->course_title }}</td>
                <td>{{$education->Qualification->label }}</td>
                <td>{{$education->start_date }} - {{$education->completion_date }}</td>
                
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-9">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('educations.show', $education->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{ route('educations.edit',$education->id) }}"><i class="fa fa-edit"></i> </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('educations.destroy',$education->id) }}" method="post"
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
