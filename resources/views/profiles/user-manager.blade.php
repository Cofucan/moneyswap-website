@extends('layouts.admin')
@section('page_title', 'User Management')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
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
     	<h3>Users Management </h3>	
	</div>
  <div class="col-md-4">

	  <div class="page_button">
    
	 	{{-- <a href="{{ url('users/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a> --}}
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
                            <th>Full Name</th>                         
                            <th>Login ID</th>                    
                            <th>Role </th>
                            <th>Last Login </th>
                            <th>Date Verified </th>
                            <th>Date Created </th>
                            <th>Status </th>
                            <th width="18%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="user{{$user->id}}">
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{ route('people.show', $user->id) }}"> {{$user->Profile->Person->full_name}} </a></td>                            
                            <td>{{$user->email}} 
                                <a data-toggle="modal" data-target="#user-info{{$user->id}}" href="#user-info{{$user->id}}"> <i class="fa fa-edit"></i> 
                                </a>
                            </td>                     
                            <td>
                                {{ $user->Profile->Role->role_name }} 
                                <a data-toggle="modal" data-target="#role{{$user->id}}" href="#role{{$user->id}}"> <i class="fa fa-edit"></i> 
                                </a>
                            </td>
                            <td>{{ $user->last_login_at}} </td>
                            <td>{{ $user->email_verified_at}} </td>
                            <td>{{ $user->created_at}} </td>
                            <td>{{ $user->status}} </td>
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-md-3">
                                        <a class="btn btn-secondary btn-sm" href="{{ route('users.show', $user->id) }}"><i class="fa fa-eye"></i></a>
                                        {{--  <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil"></i></a>  --}}
                                    </div>
                                    <div class="col-md-6">
                                        <form method="POST" action="{{ route('users.setpassword') }}">
                                                @csrf
                                            <input type="hidden" name="email" value="{{$user->email}}" />
                                            <button type="submit" class="btn btn-sm btn-warning action_btn"> <i class="fa fa-refresh"></i>Reset</button>
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                    @if(Auth::user()->profile->role_id == 1)
                                     <form action="{{ route('users.remove',$user->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                    </form>
                                    @endif
                                    </div> 
                                </div>
                            </td>
                             {{-- user modal begins--}}
                                <div class="modal fade" id="user-info{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title text-center">Update Email</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('users.swapemail') }}" id="UpdateUserEmail">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}" />
                                                    {{csrf_field()}}                                          
                                                    
                                                    <div class="form-group">
                                                        <label for="email" class="control-label">Email</label>
                                                       
                                                          <input type="email" name="email" value="{{$user->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" >
                                                        
                                                          @if ($errors->has('email'))
                                                          <span class="invalid-feedback">
                                                          <strong>{{ $errors->first('email') }}</strong>
                                                          </span>
                                                          @endif
                                                      </div>
                        
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success" type="submit">Update </button>
                                                    </div>
                                                </form>
                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- modal ends--}}

                            {{-- user modal begins--}}
                            <div class="modal fade" id="role{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title text-center">Update Role</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('changerole') }}" id="UpdateRole">
                                                <input type="hidden" name="profile_id" value="{{$user->profile_id}}" />
                                                {{csrf_field()}}                                          
                                                
                                                <div class="form-group">
                                                    <label for="role" class="control-label">Role</label>
                                                   
                                                    <select name="role_id" class="custom-select d-block w-100 select2" id="role_id" required>
                                                        @foreach($roles as $key=>$role)
                                                        @if ($user->Profile->role_id == $key)
                                                          <option value="{{$key}}" selected> {{ $role }} </option>
                                                            @else
                                                            <option value="{{$key}}"> {{ $role }} </option>
                                                        @endif
                                                          
                                                        @endforeach
                                                      </select>
                                                    
                                                      @if ($errors->has('role'))
                                                      <span class="invalid-feedback">
                                                      <strong>{{ $errors->first('role') }}</strong>
                                                      </span>
                                                      @endif
                                                  </div>
                    
                                                <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit">Update </button>
                                                </div>
                                            </form>
                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- modal ends--}}
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