@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Addresses
            </span>
        </div>
<div class="row">
  <div class="col-md-6 content_title">

     	<h3> Address </h3>	<small>The list below shows addresses available  within the school</small>
	</div>
    <div class="col-md-3">

    </div>
  <div class="col-md-3">
	  <div class="page_button">
        <a href="{{ url('addresses/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('addresses/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Street Address</th>
                    <th >Neighbourhood</th>
                    <th >City</th>
                    <th  width="12%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($addresses as $address)
            <tr>
                <td>{{$address->id}}</td>
                <td>{{$address->address_prefix}} {{$address->address_no}}, {{$address->street_name}}</td>
                <td>{{ $address->Neighbourhood->neighbourhood_name }}</td>
                <td>{{$address->Neighbourhood->City->city_name }}</td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <!-- <a class="btn btn-secondary btn-sm show" href="{{ route('addresses.show', $address->id) }}">Show</a> -->
                            <a class="btn btn-warning btn-sm" href="{{ route('addresses.edit',$address->id) }}"><i class="fa fa-edit"></i> </a>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('addresses.destroy',$address->id) }}" method="post"
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

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
