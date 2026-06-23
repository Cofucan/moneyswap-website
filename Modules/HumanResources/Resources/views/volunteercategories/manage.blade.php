@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
               Investment plan
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>

            <span class="s-text17">
                Manage
            </span>
        </div>

<div class="row">
  <div class="col-md-9 content_title">
     	<h3> Investment plans </h3>	<small>manage all plan</small>
	</div>
  <div class="col-md-3">

	  <div class="page_button">
        <a href="{{ url('investmentplans/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 
	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Package</th>
                    <th >Duration</th>
                    <th >Interest Rate</th>
                    
                    <th>Status </th>
                    <th  width="25%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($investmentplans as $investmentplan)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{ route('packages.show', $investmentplan->package_id) }}">{{ $investmentplan->Package->name }}</a></td>
                <td>{{ $investmentplan->duration}}    </td>
                <td>{{ $investmentplan->interest }}</td>           
                <td>
                    @if($investmentplan->published == 1)
                    <span class="enable">Published</span>
                    @else
                    <span class="disable"> Un published</span>
                    @endif
                </td>

                <td>
                    <div class="row no-gutters">
                        <div class="col-md-6">    
                            <a class="btn btn-primary btn-sm" href="#editplan{{ $investmentplan->id }}" data-toggle="modal" data-target="#editplan{{ $investmentplan->id }}"><i class="fa fa-edit"></i> </a>
                            @if($investmentplan->published == 1)                 
                            <a class="btn btn-warning btn-sm" href="{{ url('investmentplans/toggle', $investmentplan->id)}}"><i class="fa fa-power-off"></i></a>
                            @else                        
                            <a class="btn btn-success btn-sm" href="{{ url('investmentplans/toggle', $investmentplan->id)}}"><i class="fa fa-play-circle"></i></a>
                            @endif 
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('investmentplans.destroy',$investmentplan->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @include('investmentplans.modal')
            @endforeach
            </tbody>
            </table>
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
