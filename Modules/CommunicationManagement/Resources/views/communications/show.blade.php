@extends('layouts.admin')
 @section('page_title', $communication->subject)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

    <div class="container-fluid">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-12 col-sm-12">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                @if ( Auth::user()->profile->role_id == 1 )
                    <a href="{{ url ('clients')}}" class="s-text16">
                        Clients
                            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                        </a>
                @elseif ( Auth::user()->profile->role_id == 5 )
                    <a href="{{ url ('clients/home')}}" class="s-text16">
                        Clients
                            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                        </a>
                @endif



                <a href="{{ route ('enrolments.show', $communication->enrolment_id )}}" class="s-text16">
                    {{ $communication->Enrolment->Admission->Profile->student_name }}
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                        {{$communication->subject }}
                </span>
            </div>
            {{-- <div class="col-md-4 col-sm-6">

                <a href="{{ url('communications/manage') }}"><button class="btn btn-sm btn-primary">Manage <i class="fa fa-list"></i></button></a>
                <a href="{{ url('studentfeeitems/create') }}"><button class="btn btn-sm btn-success">Add Fee <i class="fa fa-plus"></i></button></a>
                <a class="btn btn-warning btn-sm" href="{{ route('communications.edit',$communication->id) }}">Edit <i class="fa fa-edit"></i> </a>
            </div> --}}
        </div>
    <div class="row">
  <div class="col-md-10 content_title">
     	<h5>  {{ $communication->activity_type }} Activity By: {{ $communication->User->Profile->full_name }} </h5>
	</div>

</div>

<div class="row details">

        <div class="col-xs-10 col-sm-10 col-md-10 mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>From:</strong>
                        {{ $communication->User->Profile->full_name }}
                    </div>

                    <div class="form-group">
                        <strong>To :</strong>
                        {{ $communication->Enrolment->Admission->Profile->name }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Type :</strong>
                        {{ $communication->activity_type }}
                    </div>
                </div>
            </div>




            <hr>
            <div class="form-group">
                    <strong>Title :</strong>
                    {{ $communication->subject }}
                </div>
            <hr>
            <div class="form-group">
                <strong>Description:</strong>
                {!! $communication->details !!}
            </div>



        </div>
    </div>

@endsection
