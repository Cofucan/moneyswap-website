@extends('layouts.admin')
@section('page_title', 'Manage Classification' )
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <div class="col-md-8 col-sm-6" >
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('streams/manage')}}" class="s-text16">
        Streams
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
            Manage
        </span>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="{{ url('streams/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('streams/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	</div>
</div>
<div class="row">
  <div class="col-md-8 page_title">
     	<h3> Streams </h3>
	</div>
    
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive-sm">

            <table class="table mt-4" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Classification </th>
                    <th >Section</th>
                    <th >Last Updated</th>
                    <th >Status</th>
                    <th  width="15%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($streams as $classification)
            <tr class="classification{{$classification->id}}">
                <td>{{$classification->id}}</td>
                <td>{{$classification->label}}</td>
                <td>{{$classification->Section->section_name}}</td>
                <td>{{ $classification->updated_at }}</td>
                <td>
                @if($classification->published == 1)
                <span class="enable">Published</span>
                @else
                <span class="disable"> Not Published</span>
                @endif

                </td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-7">
                            <a class="btn btn-primary btn-sm" href="{{ route('streams.edit',$classification->id) }}"><i class="fa fa-edit"></i> </a>
                            <a class="btn btn-secondary btn-sm" href="{{ route('streams.show',$classification->id) }}"><i class="fa fa-eye"></i> </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('streams.destroy',$classification->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>

                </td>

<!--
                <form action="{{ route('streams.changestatus', $classification->id) }}" method="post"
                    onsubmit="return confirm('Action Publish/Unpublish the record. Continue?');">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put" />
                    <input type="hidden" name="id" value="{{ $classification->id }}" />
                    <button type="submit" class="btn btn-sm btn-info action_btn"> <i class="fa fa-gear"></i>Change Status</button>
                </form> -->

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
