@extends('layouts.admin')
@section('page_title', 'Agent Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Agents </li>

        </ol>
    </nav>
<div class="row mt-4">
    <div class="col-md-10 col-6 content_title">
     	<h4>Agent Register</h4>	<small></small>
	</div>
    <div class="col-md-2 col-6">

    </div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table w-100" id="table">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Agent Name</th>
                        <th >Occupation</th>
                        <th >No. of Wards </th>
                        <th >Status </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agents as $agent)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $agent->name }}  </td>
                        <td>{{ $agent->occupation ?? 'N/A' }}</td>
                        <td>{{ $agent->Clients->count() }}</td>
                        <td>@if($agent->is_active == true)
                            Active
                            @else
                            Not Active
                            @endif
                        </td>
                    </tr>


                    @endforeach
                </tbody>
            </table>
        </div>
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
