@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="row">
                <div class="col-md-7">
                    <a href="{{ url ('home')}}" class="s-text16">
                        <i class="fa fa-home"></i> Dashboard
                        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                    </a>
                    <span class="s-text17">
                    Profiles
                    </span>
                </div>
                <div class="col-md-5">
                    {{-- <a href="{{url('profiles/export')}}" class="btn btn-sm btn-warning">Export  </a>              --}}

                </div>
            </div>
        </div>
<div class="row">
  <div class="col-md-6 content_title">

         <h3> Profiles </h3>
         <small>

         </small>
	</div>
  <div class="col-md-3">
		
	  
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th>#</th>
                   
                    <th>Common Name </th>
                    <th>Contact Person</th>
                    <th> Email</th>
                    <th> Telephone</th>
                    <th>Category </th>
                    <th>Created At </th>
                    <th>Status</th>
                </tr>
            </thead>
        <tbody>
            @foreach($profiles as $profile)
            <tr>
                <td>{{$loop->iteration}}</td>               
                <td>{{$profile->name }}</td>
                <td>{{$profile->full_name }}</td>
                <td>{{ !empty($profile->DefaultEmail->contact_value) ? $profile->DefaultEmail->contact_value : 'None'}}  </td>
                <td> {{ !empty($profile->DefaultPhone->contact_value) ? $profile->DefaultPhone->contact_value : 'None'}} </td>
                <td>{{$profile->Role->role_name }} </td>
                <td>{{$profile->created_at }} </td>
                <td>
                    {{$profile->status }}
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