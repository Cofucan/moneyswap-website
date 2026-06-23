@extends('layouts.admin')
@section('page_title', 'Users')

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
                    Users
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="{{ url('profiles/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                <a href="{{ url('profiles/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
                <a href=""><button class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></button></a>
            </div>
	</div>

<div class="row">
    <div class="col-md-8 content_title">
     	<h3> Users </h3>
	</div>

</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

    </div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender </th>
                        <th>Roles </th>
                        <th width="12%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="user{{$user->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td><a href="{{ route('profiles.show', $user->id) }}"> {{$user->Person->full_name}} </a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->telephone}}</td>

                        <td>{{$user->Person->gender}}</td>
                        <td>
                        @foreach ($user->Roles as $role)

                            <div class="row">
                            <div class="col-md-5">{{ $role->role_tag }}</div>
                            <div class="col-md-3"> <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-edit btn-sm" data-toggle="modal" data-target=".bd-example-modal{{$user->id}}">
                                            Edit
                                    </button>

                                </div>
                            {{-- modal begins--}}
                                <div class="modal fade bd-example-modal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Editing {{$user->Person->full_name}} role</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="POST" action="{{ route('profiles.addrole', $user->id) }}" id="UpdateDesignation" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <input type="hidden" name="user_id" id="social_handle_id" value="{{$user->id}}">
                                                    <input type="hidden" name="profile_id" id="social_handle_id" value="{{$user->id}}">
                                                    <div class="form-group has-feedback">
                                                            <label for="role_id">Role<span class="text-muted"> *</span></label>
                                                              <select name="role_id" class="custom-select select2 d-block w-100" id="role_id" required>
                                                                @foreach($roles as $key => $role)
                                                                @if( $user->role_id == $key)
                                                                <option value="{{$key}}" selected> {{$role}}</option>
                                                                    @else
                                                                    <option value="{{$key}}"> {{$role}}</option>
                                                                    @endif
                                                                @endforeach
                                                              </select>

                                                            @if ($errors->has('role_id'))
                                                              <span class="invalid-feedback">
                                                              <strong>{{ $errors->first('role_id') }}</strong>
                                                              </span>
                                                            @endif
                                                          </div>

                                                    <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit">Save </button>
                                                    <button class="btn btn-primary" type="reset">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- modal ends--}}
                            </div>
                        @endforeach
                        </td>
                         <td>
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <a class="btn btn-primary btn-sm" href="{{ route('profiles.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
                                </div>
                                <div class="col-md-8">
                                    <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{$user->id}}">
                                     Add role
                                    </button>
                                    {{-- modal begins--}}
                                        <div class="modal fade bd-example-modal-lg{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title text-center">Adding Role to {{$user->Person->full_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form method="POST" action="{{ route('profiles.addrole') }}" id="AddRole">
                                                            {{csrf_field()}}

                                                            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                                                            {{--  @include('profiles._user')  --}}

                                                            <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit">Add Role </button>
                                                            <button class="btn btn-primary" type="reset">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- modal ends--}}
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
