@extends('layouts.admin')
@section('page_title', 'Parents Register')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Agents </li>

            <div class="ml-auto mr-0">
                @if (Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11                                                                 || Auth::user()->Profile->role_id == 16)
                <a href="{{ url('agents/create') }}" class="btn btn-sm btn-success">Add Agent <i class="fa fa-plus"></i></a>
                <a href="{{ url('agents/upload') }}" class="btn btn-sm btn-warning">Bulk Upload  <i class="fa fa-arrow-down"></i></a>


                @endif
            </div>
        </ol>
    </nav>
{{-- @include('employmentmanagement::agents._stats') --}}
<div class="row mt-4">
    <div class="col-md-10 col-6 content_title">
     	<h4>Parents Register</h4>	<small></small>
	</div>
    <div class="col-md-2 col-6">

    </div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive-sm">
            <table class="table w-100" id="table">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Name</th>
                        <th >Telephone</th>
                        <th >Wards </th>
                         <th >Outstanding </th>
                        <th  width="25%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agents as $agent)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $agent->name }}  </td>
                        <td>{{ $agent->telephone }}  </td>
                        <td>{{ $agent->wards }}</td>
                        <td>{{ number_format($agent->Invoices->sum('balance'),2)}}</td>
                        <td>
                            <div class="row">
                                @include('profilemanagement::agents._actions')
                            </div>
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
