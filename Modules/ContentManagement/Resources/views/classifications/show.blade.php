@extends('layouts.admin')
@section('page_title', $classification->label )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')


    <div class="container-fluid">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 col-sm-6">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('streams/manage')}}" class="s-text16">
                    Streams
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    {{ $classification->label }}
                </span>
            </div>
            <div class="col-md-4 col-sm-6">

                <a href="{{ url('streams/manage') }}"><button class="btn btn-sm btn-primary">Manage <i class="fa fa-list"></i></button></a>
                <a href="{{ url('streams/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                <a class="btn btn-warning btn-sm" href="{{ route('streams.edit',$classification->id) }}"><i class="fa fa-pencil"></i> Edit</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 content_title">
                <div class="form-classification">
                    <h3>  {{ $classification->label }} </h3>
                </div>
                <div class="form-classification">
                <strong>Section:</strong>
                {{ $classification->Section->section_name }}
                </div>
                <hr>
                <div class="form-classification">

                    <strong>Default Classification:</strong>
                    <strong>Status :</strong>
                        @if($classification->default_group == 1)
                            Yes
                        @else
                        No
                        @endif

                </div>
                <hr>
                <div class="form-classification">

                    <strong>Classification Description:</strong>
                    {!! $classification->overview !!}
                </div>

            </div>
             <div class="col-md-6">

            </div>

        </div>

    <div class="row">
            <div class="col-md-6">
                    <ul>
                            @foreach($classification->Subjects as $subject)
                            <li>  {{ $subject->subject_code }} {{ $subject->pivot->mandatory_status }} </li>
                            @endforeach
                    </ul>
            </div>
                <div class="col-md-6">
                    <h4>Classification Only </h4>
                        
                </div>

    </div>



    </div>


@endsection
