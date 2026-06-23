@extends('layouts.admin')
@section('page_title', 'People')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
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
                </span>mo
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="{{ url('profiles/create') }}" class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></a>
                <a href="{{ url('profiles/upload') }}" class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></a>
                <a href="{{ url('profiles/export') }}" class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></a>
            </div>
	</div>

<div class="row">
    <div class="col-md-8 content_title">
     	<h3> Employees Without Login Access </h3>	
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Birthday</th>
                        <th>Gender </th>
                        <th width="25%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                    <tr class="profile{{$profile->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$profile->full_name}} </td>
                        <td>{{$profile->birthday}}</td>
                        <td>{{$profile->gender}}</td>
                         <td>
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('profiles.show', $profile->id) }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('profiles.edit',$profile->id) }}"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-warning btn-sm mb-3 " data-toggle="modal" data-target="#profile{{ $profile->id }}">
                                        Add Role
                                    </button>   
                     {{-- profile modal begins--}}
                        <div class="modal fade" id="profile{{ $profile->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title text-center">Edit</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('profiles.makeuser') }}" id="MakeUser">
                                    {{csrf_field()}}
                                        <input type="hidden" name="person_id" value="{{$profile->id}}">
                                        
                                        <div class="form-group mb-3">
                                                <label for="email">Email</label>
                                                <input id="email" type="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group mb-3 ">
                                                <label for="telephone">Telephone</label>
                                                <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" required>
                                               
                                                @if ($errors->has('telephone'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('telephone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                              <div class="mb-3 form-group">
                                                <label for="role_id">Role</label>
                                                <select name="role_id" class="custom-select d-block w-100 select2" id="role_id" required>
                                                    <option>Choose Role</option>
                                                    @foreach($roles as $key => $role)
                                                    @if(old('role_id') == $key)
                                                    <option value="{{$key}}" selected> {{$role}}</option>
                                                    @else
                                                    <option value="{{$key}}"> {{$role}}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                                @if ($errors->has('role_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('role_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Make User </button>
                                           
                                        </div>
                                    </form>

                                </div>
                            </div>
                            </div>
                        </div>
                    {{-- modal ends--}}

                                </div>
                                <div class="col-md-3">
                                {{--  <form action="{{ route('profiles.destroy',$profile->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                </form>  --}}
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
