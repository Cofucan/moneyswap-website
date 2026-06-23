@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
<nav aria-label ="breadcrumb mb-3">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>                
      <li class="breadcrumb-item active" aria-current="page"> Contacts </li>
     <div class="ml-auto mr-0">
        <a href="#newcontact" data-toggle="modal" data-target="#newcontact" class="btn btn-sm btn-success">Add Contact</a>
        <div class="modal fade" id="newcontact" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-center">Add Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('contacts.store') }}" id="CreateContact">
                    {{csrf_field()}}
                    @include('contactmanagement::contacts.completeform')    
                    <div class="modal-footer">                           
                        <button class="btn btn-primary px-4" type="submit" >Save</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    
    </div>
  </ol>
</nav>

<div class="row">
  <div class="col-md-9">
     	<h3> Contacts </h3>	<small>The list below shows the contacts created</small>
  </div>
 
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="table-responsive"> -->
            <table class="table w-100" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Company Name</th>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Telephone</th>
                    <th  width="15%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$contact->company_name}}</td>
              <td>{{$contact->full_name}}</td>
              <td>{{$contact->email}}</td>
              <td>{{$contact->telephone}}</td>
              <td>
                  <div class="row no-gutters">
                      <div class="col-md-8">
                          <a class="btn btn-primary btn-sm" data-toggle="modal" href="#edit{{$contact->id}}" data-target="#edit{{ $contact->id}}">Edit</a>
                      </div>
                      <div class="col-md-3">
                          <form action="{{ route('contacts.destroy',$contact->id) }}" method="post"
                              onsubmit="return confirm('Are you sure you want to delete this record?');">
                              <input type="hidden" name="_method" value="DELETE" />
                              {{ csrf_field() }}
                              <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                          </form>
                      </div>
                  </div>
          </tr>
          @include('contactmanagement::contacts._modaledit')
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
