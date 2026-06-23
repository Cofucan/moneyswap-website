@extends('layouts.admin')
 @section('page_title', $department->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

    <div class="container-fluid">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('departments/manage')}}" class="s-text16">
                    Departments
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    {{$department->label}}
                </span>
            </div>
            @if ( Auth::user()->profile->role_id == 1)
            <div class="col-md-4">
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-department{{$department->id}}" href="#edit{{$department->id}}"> Edit</a>
            @include('departments._formedit')
            </div>
            @endif
        </div>
    <div class="row">
  <div class="col-md-8 content_title">
     	{{-- <h3>  {{ $department->label }} </h3> --}}
    </div>

</div>

<div class="row details mt-2">

        <div class="col-md-6">
            <div class="form-group">
                <strong> Department :</strong>
                {{ $department->label }}
            </div>


            <hr>
            <div class="form-group">
                <strong>Description:</strong>
                {!! $department->overview !!}
            </div>

        </div>
    </div>

<div class="row">

    <div class="col-md-9 col-sm-12 col-xs-12">
            <h5 class="mt-2"> Roles </h5>
    </div>
    <div class="col-md-9 table-responsive">
        @if ($department->Roles->count() == 0)
            <p class="text-red">No Roles in this department</p>
            @else
            <table class="table w-100">
                <thead>
                    <th> S/N</th>

                    <th>Title</th>
                    <th>Description</th>

                </thead>
                <tbody>
                    @foreach ($department->Roles as $role)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $role->role_name}} </td>
                            <td>{{ $role->role_description }} </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif

    </div>
    </div>

</div>

@endsection
