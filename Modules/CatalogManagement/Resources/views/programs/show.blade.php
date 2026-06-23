@extends('layouts.admin')
 @section('page_title', $program->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">

@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('programs/manage') }}">  Programs</a></li>

            <li class="breadcrumb-item active" aria-current="page"> {{$program->label}} </li>

            <div class="ml-auto mr-0">

            </div>

        </ol>
    </nav>
    <div class="row details">

        <div class="col-sm-6 col-md-6">

            <h4>    {{ $program->label }}</h4>

            <p>
                <strong>Graduation Qualification :</strong>
                {{ $program->graduation_qualification }}
            </p>



            <div class="form-group">
                {!! $program->overview !!}
            </div>

            <hr>


        </div>

        <div class="col-md-12 mb-3">

            <div class="main mt-3">
                <div class="card">
                    <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-levels-tab" data-toggle="tab" href="#nav-levels" role="tab" aria-controls="nav-levels" aria-selected="false">Level</a>
                        <a class="nav-item nav-link" id="nav-fees-tab" data-toggle="tab" href="#nav-fees" role="tab" aria-controls="nav-fees" aria-selected="false">Fees </a>
                    </div>
                    </nav>
                    <div class="card-body">
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-fees" role="tabpanel" aria-labelledby="nav-fees-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="nav-box mb-3">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <h4>Fees </h4>
                                                </div>
                                                <div class="col-md-3">
                                                    {{-- <a href="#feecreate" class="btn btn-success btn-sm" data-toggle="modal" data-target="#feecreate"> Add Fee Schedule</a> --}}
                                                    {{-- modal begins--}}
                                                        {{-- <div class="modal fade" id="feecreate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-center">New Fee Schedule</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    {{-- modal ends--}}

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="nav-levels" role="tabpanel" aria-labelledby="nav-levels-tab">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="nav-box">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <h4>Classes</h4>
                                                </div>
                                                <div class="col-md-3">

                                                    <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#createquiz">
                                                    Add Level
                                                    </button>
                                                    <div class="modal fade" id="createquiz" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-center"> Add Level</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="{{ route('levels.store') }}" id="CreateLevel">
                                                                    {{csrf_field()}}
                                                                        <input type="hidden" class="form-control" name="program_id" id="program_id"/>
                                                                        @include('catalogmanagement::levels._form')                                                                           --}}

                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-warning" type="submit" name="status" value="Draft">Continue</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            @if ($program->Levels->count() > '0')
                                            <div class="row">
                                                @foreach ($program->Levels as $level)
                                                <div class="col-md-3 col-md-4 col-sm-6 mb-2">
                                                    @include('catalogmanagement::levels._single')
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <h5 class="text-danger">No Class added yet</h5>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
