@extends('layouts.admin')
@section('page_title','Telephone Directory')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<nav aria-label ="breadcrumb mb-3">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page"> Telephone Directory</li>

      <div class="ml-auto mr-0">
        
      </div>
  </ol>
</nav>
      
<div class="row">
  <div class="col-md-9 content_title">
     	<h3> Telephone Directory </h3>	<small>The list below shows the contacts created</small>
  </div>
  
  
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="table-responsive"> -->
            <table class="table w-100" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Owner</th>
                    <th >Telephone </th>
                    <th >Tag </th>
                    <th  width="15%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($telephones as $telephone)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$telephone->owner}}</td>
                <td>{{$telephone->phone_number}}</td>
                <td>{{$telephone->phone_tag}}</td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-8">
                        <a data-toggle="modal" class="btn btn-primary btn-sm" data-target="#telephone-info{{$telephone->id}}" href="#telephone-info{{$telephone->id}}">
                            Edit
                        </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('telephones.destroy',$telephone->id) }}" method="post"
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
