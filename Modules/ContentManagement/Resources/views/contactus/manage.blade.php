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

        <a href="{{ url ('contacts/manage')}}" class="s-text16">
          Contacts
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Manage
        </span>
    </div>
<div class="row">
  <div class="col-md-9 content_title">
     	<h3> Contacts </h3>	<small>The list below shows the contacts create for various views</small>
	</div>
  <div class="col-md-3">

	  <div class="page_button">
        <a href="{{ url('contacts/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('contacts/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
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
                    <th >Contact Owner</th>
                    <th >Contact Type</th>
                    <th >Contact </th>
                    <th >Contact tag </th>
                    <th  width="20%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{$contact->id}}</td>
                <td>{{$contact->contactable_type}}</td>
                <td>{{$contact->contact_type}}</td>
                <td>{{$contact->contact_value}}</td>
                <td>{{$contact->contact_tag}}</td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            <a class="btn btn-secondary btn-sm" href="{{ route('contacts.show', $contact->id) }}">Show</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('contacts.edit',$contact->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                        <div class="col-md-1">
                            <form action="{{ route('contacts.destroy',$contact->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> Delete</button>
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
