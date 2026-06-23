@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
               Salary Scale
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>

            <span class="s-text17">
                Manage
            </span>
        </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Salary Scales </h3>	<small>The list below shows the salaryscales created</small>
	</div>
  <div class="col-md-4">

	  <div class="page_button">
        <a href="{{ url('salaryscales/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('salaryscales/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="table-responsive"> -->
            <table class="table w-100" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Salary Scale </th>
                    <th >Qualification</th>
                    <th >Description</th>
                    <th  width="15%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($salaryscales as $salaryscale)
            <tr>
                <td>{{$salaryscale->id}}</td>
                <td>{{ $salaryscale->salary_scale}}</td>
                <td>{{$salaryscale->Qualification->qualification }}</td>
                <td>{{$salaryscale->salary_scale_descripion }}</td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-9">
                            <a class="btn btn-secondary btn-sm" href="{{ route('salaryscales.show', $salaryscale->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{ route('salaryscales.edit',$salaryscale->id) }}"><i class="fa fa-edit"></i></a>
                        </div>
                        <div class="col-md-1">
                            <form action="{{ route('salaryscales.destroy',$salaryscale->id) }}" method="post"
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
