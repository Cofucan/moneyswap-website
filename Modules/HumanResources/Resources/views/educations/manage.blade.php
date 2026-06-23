@extends('layouts.admin')
@section('page_title','Manage Qualifications' )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
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
                Academic Records
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>

            <span class="s-text17">
                Manage
            </span>
        </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> {{$profile->name}}'s Academic History </h3>
	</div>
  <div class="col-md-4">

	  <div class="page_button">
     {{--  @if($education->profile_id == Session::get('profile_id'))
        <a href="{{ url('educations/create') }}"><button class="btn btn-sm btn-success">Create Job <i class="fa fa-plus"></i></button></a>
	 	  @endif --}}
		<a href=""><button class="btn btn-sm btn-success">Print  <i class="fa fa-arrow-up"></i></button></a>
	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="table-responsive">
            <table class="table w-100" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Qualification</th>
                    <th >Institution</th>
                    <th >Period</th>
                    <th >Level Point</th>
                    <th > Visibility</th>
                    <th >Published </th>
                    <th  width="30%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($educations as $education)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                 {{$education->Qualification->acronym}} {{$education->major}}
                </td>
                <td>
                    <b>{{$education->Organization->organization_name}}</b>
                  </td>
                <td>{{$education->period}}</td>
                <td>{{$education->cgpa }}</td>
                <td>{{ $education->visibility }}</td>
                <td>
                  @if($education->published == '1')
                  Published
                  @else
                  Unpublished
                  @endif
                </td>
                <td>
                    <div class="row no-gutters">
                      <div class="col-md-3 col-6">
                          <a class="btn btn-secondary btn-sm show" href="{{ route('educations.show', $education->id) }}"><i class="fa fa-eye"> More</i></a>
                      </div>
                      {{-- <div class="col-md-3 col-6">
                          <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#profile-info{{$profile->id}}">
                              <i class="fa fa-edit"></i>
                          </button>
                      </div> --}}
                      @if($education->profile_id == Session::get('profile_id'))
                      <div class="col-md-3 col-6">
                          @if($education->published == '1')
                          <a class="btn btn-warning btn-sm" href="{{ url('educations/toggle', $education->id)}}"><i class="fa fa-power-off"> Unpublish</i></a>
                          @else
                          <a class="btn btn-success btn-sm" href="{{ url('educations/toggle', $education->id)}}"><i class="fa fa-play-circle-o"> Publish</i></a>
                          @endif
                      </div>
                      <div class="col-md-3 col-6">
                          <form action="{{ route('educations.destroy',$education->id) }}" method="post"
                              onsubmit="return confirm('Are you sure you want to delete this record?');">
                              <input type="hidden" name="_method" value="DELETE" />
                              {{ csrf_field() }}
                              <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash">Delete</i></button>
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

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
