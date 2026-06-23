@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
             Service Requests
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>

            <span class="s-text17">
                Manage
            </span>
        </div>
      <div class="row">
        <div class="col-md-9 content_title">
            <h3> Service Requests </h3>
        </div>

      </div>
      <div class="row ">
        <div class="col-md-12 col-sm-12 student-info ">
          <div class="table-responsive"> 
            <table class="table w-100 " id="table">
                <tbody>
                  
                  <thead>
                    <th ># </th>
                    {{-- <th >Subject</th> --}}
                    <th >Service</th>
                    <th >Location</th>
                    <th >Telephone</th>
                    <th >Email</th>
                    <th >Date Submitted</th>
                    <th  width="20%">Actions</th>
                    </thead>
                  @foreach($briefs as $brief)
                  <tr>
                        <td>{{$brief->id}}</td>                            
                        {{-- <td>{{ $brief->brief_subject }}</td> --}}
                        <td>{{ $brief->Expertise->expertise_title }}</td>                       
                        <td>{{$brief->contact_name}}</td>
                        <td>{{$brief->telephone}}</td>
                        <td>{{$brief->email }}</td>
                        <td>{{$brief->date_created }}</td>
                        <td>
                            <div class="row no-gutters">
                                <div class="col-md-9">
                                  <a class="btn btn-secondary btn-sm" href="{{ route('briefs.show', $brief->id) }}"><i class="fa fa-eye"></i></a>
                                  {{--  <a class="btn btn-primary btn-sm" href="{{ route('briefs.edit',$brief->id) }}"><i class="fa fa-edit"></i> </a>  --}}
                                </div>
                                
                            </div>
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
