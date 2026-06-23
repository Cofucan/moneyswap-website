@extends('layouts.admin')
@section('page_title', 'Member Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Members </li>

            <div class="ml-auto mr-0">
                @if (Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11                                                                 || Auth::user()->Profile->role_id == 16)
                <a href="{{ url('members/create') }}" class="btn btn-sm btn-success">Add Member <i class="fa fa-plus"></i></a>
                {{-- <a href="{{ url('members/export') }}" class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></a>     --}}


                @endif
            </div>
        </ol>
    </nav>
{{-- @include('employmentmanagement::members._stats') --}}
<div class="row mt-4">
    <div class="col-md-10 col-6 content_title">
     	<h4>Member Register</h4>
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
                        <th >Member Name</th>
                        <th >Position</th>
                        <th >Status </th>
                        <th  width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $member->Profile->full_name }}  </td>
                        <td>{{ $member->position ?? 'N/A' }}</td>
                        <td>{{ $member->status }}</td>

                        <td>
                            <div class="row no-gutters">
                                <div class="col-md-9">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('members.show', $member) }}">Details</a>
                                    @if($member->is_active == true)
                                    <a class="btn btn-warning btn-sm" href="{{ url('members/toggle', $member)}}">Deactivate</a>
                                    @else
                                    <a class="btn btn-success btn-sm" href="{{ url('members/toggle', $member)}}">Activate</a>
                                    @endif
                                </div>
                               
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
