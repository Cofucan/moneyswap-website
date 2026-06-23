@extends('layouts.admin')
 @section('page_title', $education->contact_type)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')
    

    <div class="container">
        <div class="row">
            <div class="col-md-6 content_title">
                <h3>  {{ $education->contact_type }} </h3>
            </div>
            <div class="col-md-5">
                <div class="page_button">
                    <a href="{{ url('educations/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
                    <a href="{{ url('educations/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                    <a class="btn btn-primary btn-sm" href="{{ route('events.edit',$education->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                    <a class="btn btn-sm btn-success" href="{{ route('events.edit',$education->id) }}"><i class="fa fa-print"></i> Print</a>
                    <a class="btn btn-sm btn-success" href="{{ route('events.edit',$education->id) }}"><i class="fa fa-print"></i> Share</a>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contact Type :</strong>
                    {{ $education->contact_type }}
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $education->contact_tag }}
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                <img src="{{ asset ($education->thumbnail) }}" alt="{{$education->contact_type }}">
                </div>
            </div>

        </div>
    </div>
@endsection
