@extends('layouts.admin')
@section('page_title', 'Post Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
               Posts
            </span>
        </div>
<div class="row">
  <div class="col-md-6 content_title">

     	<h3> Posts </h3>	<small>The list below shows messages available </small>
	</div>
    <div class="col-md-2">

    </div>
  <div class="col-md-4">
	  <div class="page_button">
        <a href="{{ url('messages/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('messages/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Email Subject</th>
                    <th >from_email</th>
                    <th > Status</th>
                    <th  width="20%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($messages as $messagetemplate)
            <tr class="messagetemplate{{$messagetemplate->id}}">
                <td>{{$messagetemplate->id}}</td>
                <td>{{$messagetemplate->message_subject}}</td>
                <td>{{$messagetemplate->from_email}}</td>
                <td>
                @if($messagetemplate->published == 1)
                <span class="enable">Published</span>
                @else
                <span class="disable"> Not Published</span>
                @endif

                </td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-9">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('messages.show', $messagetemplate->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{ route('messages.edit',$messagetemplate->id) }}"><i class="fa fa-pencil"></i> </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('messages.destroy',$messagetemplate->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                </td>
                <td>

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
