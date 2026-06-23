@extends('layouts.admin')
@push('styles')    
<link rel="stylesheet" href="{{ asset ('css/select2.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
  .incident a:hover{
    text-decoration: none;
  }
  .incident a:hover h6{
    font-weight: 800;
  }
</style>
@endpush
@section('content')

<section>
    <div class="container">
        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Incidents</li>
                <div class="ml-auto mr-0">
					<a href="#new" class="btn btn-sm btn-success" data-target="#new" data-toggle="modal">Report an Incident</a>
					@include('incidents._modal')
                </div>
            </ol>
        </nav>
       
        <div class="row">
          {{-- <div class="col-md-2 col-sm-3 side-menu">
             
          </div> --}}
          <div class="col-md-9 col-sm-9 announcement">
              <h4> Incident </h4>
			  <p>Please use this page to submit an incident to us. Kindly ensure that you provide as much details as necessary</p>
			  	
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
					  <div class="table-responsive">
						<table id="table" class="table">
							<thead>
							<tr>
								<th> # </th>
								<th>Incident</th>
								<th>Category</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($incidents as $incident)
								<tr>
								<td>{{ $loop->iteration }} </td>
								<td>{{ $incident->label }} - <small>{{ $incident->severity }}</small></td>
								<td>{{ $incident->IncidentCategory->label }}</td>
								
								<td><a class="btn btn-primary btn-sm" href="{{ route('incidents.show', $incident->slug) }}">Details</a></td>
						</tr>
							@endforeach
							</tbody>
						</table>
                    </div>
                  </div>
              </div>
			  
			  
          </div>
      </div>
    </div>
</section>

@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
    </script>
  @endpush