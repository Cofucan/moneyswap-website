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
              <h4> Incident Manage</h4>
          
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
								<td>{{ $loop->iteration }}</td>
								<td>{{ $incident->label }} - {{ $incident->severity }}</td>
								<td>{{ $incident->IncidentCategory->label }}</td>
						
								<td>
									<div class="row no-gutters">
									<div class="col-md-5">
										<a class="btn btn-primary btn-sm" href="{{ route('incidents.show', $incident->slug) }}">Details</a>
									</div>
									@if ($incident->status == 'Scheduled' && $incident->user_id == Auth::id())									
									<div class="col-md-3">
										<form action="{{ route('incidents.destroy',$incident->id) }}" method="post"
											onsubmit="return confirm('Are you sure you want to delete this record?');">
											<input type="hidden" name="_method" value="DELETE" />
											{{ csrf_field() }}
											<button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
										</form>
									</div>	
									@endif
								</div>
									</td>
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