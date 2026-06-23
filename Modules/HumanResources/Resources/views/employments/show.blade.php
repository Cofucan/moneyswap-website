@extends('layouts.admin')
 @section('page_title', $employment->contact_type)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')
    

    <div class="container">
        <div class="row">
            <div class="col-md-6 content_title">
                <h3>  {{ $employment->contact_type }} </h3>
            </div>
            <div class="col-md-5">
                <div class="page_button">
                    <a href="{{ url('events/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
                    <a href="{{ url('events/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                    <a class="btn btn-primary btn-sm" href="{{ route('events.edit',$employment->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                    <a class="btn btn-sm btn-success" href="{{ route('events.edit',$employment->id) }}"><i class="fa fa-print"></i> Print</a>
                    <a class="btn btn-sm btn-success" href="{{ route('events.edit',$employment->id) }}"><i class="fa fa-print"></i> Share</a>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contact Type :</strong>
                    {{ $employment->Designation->job_role }}
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Acomplishiments:</strong>
                    {{ $employment->accomplishments }}
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                <img src="{{ asset ($employment->thumbnail) }}" alt="{{$employment->contact_type }}">
                </div>
            </div>

        </div>
    </div>
@endsection
