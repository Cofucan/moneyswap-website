@extends('layouts.admin')
@section('page_title', 'Users')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
@endpush

@section('content')
 <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text16">
			Products
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</span>

		<span class="s-text17">
			Manage
		</span>
	</div>

<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Products </h3>	<small>It all starts here</small>
	</div>
  <div class="col-md-4">

	  <div class="page_button">
        <a href="{{ url('products/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('products/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
       
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Person </th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Ref. Code</th>
                        <th>Last Login </th>
                        <th>Last Login Ip </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="user{{$user->id}}">
                        <td>{{$user->id}}</td>
                        <td>{{$user->Person->salutation}} {{$user->Person->last_name}} {{$user->Person->first_name}}</td>
                        <td>{{$user->telephone}}</td>
                        <td>{{$user->referral_code}}</td>
                        <td>{{$user->last_login_at}}</td>
                        <td>{{$user->last_login_ip}}</td>
                         <td>
                            <div class="row no-gutters">
                                <div class="col-md-8">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('users.show', $user->id) }}"><i class="fa fa-eye"></i></a>
                                    {{--  <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>  --}}
                                </div>
                                {{--  <div class="col-md-3">
                                <form action="{{ route('users.destroy',$user->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                </form>
                                </div>  --}}
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