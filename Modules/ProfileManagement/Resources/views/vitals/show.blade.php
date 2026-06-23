@extends('layouts.admin')
 @section('page_title', $ailment->name)
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

                <a href="{{ url ('ailments/manage')}}" class="s-text16">
                    Ailments
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    {{$ailment->name}}
                </span>
            </div>
            @if ( Auth::user()->profile->role_id == 1)
            <div class="col-md-4">
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-ailment{{$ailment->id}}" href="#edit{{$ailment->id}}"> Edit</a>
            @include('ailments._formedit')
            </div>
            @endif
        </div>
    <div class="row">
  <div class="col-md-8 content_title">
     	{{-- <h3>  {{ $ailment->name }} </h3> --}}
    </div>

</div>

<div class="row details mt-2">

        <div class="col-md-6">
            <div class="form-group">
                <strong> Ailment :</strong>
                {{ $ailment->name }}
            </div>


            <hr>
            <div class="form-group">
                <strong>Description:</strong>
                {!! $ailment->overview !!}
            </div>

        </div>
    </div>

<div class="row">

    <div class="col-md-9 col-sm-12 col-xs-12">
            <h5 class="mt-2">Medical Conditions </h5>
    </div>
    <div class="col-md-9 table-responsive">
        @if ($ailment->MedicalConditions->count() == 0)
            <p class="text-red">No Medical Conditions in this ailment</p>
            @else
            <table class="table w-100">
                <thead>
                    <th> S/N</th>
                    <th>Person</th>
                    <th>Severity</th>

                </thead>
                <tbody>
                    @foreach ($ailment->MedicalConditions as $sickness)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $sickness->full_name}} </td>
                            <td>{{ $sickness->severity }} </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif

    </div>
    </div>

</div>

@endsection
