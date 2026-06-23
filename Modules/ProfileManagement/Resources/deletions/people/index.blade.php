@extends('layouts.admin')
@section('page_title', 'People')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
@endpush

@section('content')
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 content_title">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    People
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="{{ url('people/create') }}" class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></a>
                <a href="{{ url('people/upload') }}" class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></a>
                <a href="{{ url('people/export') }}" class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></a>
            </div>
	</div>

<div class="row">
    <div class="col-md-8 content_title">
     	<h3> People Without Login Access </h3>	
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Birthday</th>
                        <th>Gender </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($people as $person)
                    <tr class="person{{$person->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$full_name}} </td>
                        <td>{{$person->birthday}}</td>
                        <td>{{$person->gender}}</td>
                         <td>
                            <div class="row no-gutters">
                                <div class="col-md-8">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('people.show', $person->id) }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('people.edit',$person->id) }}"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div class="col-md-3">
                                <form action="{{ route('people.destroy',$person->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
    jQuery(document).ready(function($) {
        $('#table').DataTable();
    } );
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
 @endpush
