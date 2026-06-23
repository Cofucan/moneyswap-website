@extends('layouts.admin')
@section('page_title', 'Lead')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<nav aria-label ="breadcrumb mb-3">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>                
      <li class="breadcrumb-item active" aria-current="page"> Leads </li>
     <div class="ml-auto mr-0">
        <a href="#newlead" data-toggle="modal" data-target="#newlead" class="btn btn-sm btn-success">Add Lead</a>
        <div class="modal fade" id="newlead" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-center">Add Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('leads.store') }}" id="CreateLead">
                    {{csrf_field()}}
                    @include('contactmanagement::leads._form')    
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
     	<h3> Leads </h3>	<small>The list below shows the leads created</small>
  </div>
 
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="table-responsive"> -->
            <table class="table w-100" id="table">
            <thead>
              @include('contactmanagement::leads._tablehead')
            </thead>
            <tbody>
                @foreach($leads as $lead)
                  @include('contactmanagement::leads._tabledata')
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
