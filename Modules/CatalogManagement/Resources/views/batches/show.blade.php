@extends('layouts.admin')
 @section('page_title', $batch->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">

@endpush
@section('content')
<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{ url('programs/manage')}}">Programs</a></li>
        <li class="breadcrumb-item"> <a href="{{ url('batches/manage')}}">Class Batch</a></li>
        <li class="breadcrumb-item"> <a href="{{ route('levels.show', $batch->Level)}}">{{ $batch->Level->label }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $batch->label }}</li>
        <div class="ml-auto mr-0">
            @if ( $batch->Officials()->where('employee_id', Session::get('employee_id'))->exists() || Auth::user()->Profile->role_id == 16)
                <a class="btn btn-warning btn-sm" href="{{ route('attendances.report',$batch) }}">View Attendance</a>
                <a class="btn btn-primary btn-sm " href="{{ route('attendances.bulkcreate', $batch) }}">Take Attendance</a>
                @if ((Auth::user()->Profile->role_id == 16 || $batch->Officials()->where('employee_id', Session::get('employee_id'))->exists()) && $batch->Enrolments->count() > 0 )
                <a class="btn btn-success btn-sm px-3" href="#enterscore" data-target="#enterscore" data-toggle="modal">Enter Score</a>
                    @include('resultmanagement::scores._batchscoremodal')

                @endif
            @endif
        </div>
        @if ((Auth::user()->Profile->role_id == 16 || $batch->Officials()->where('employee_id', Session::get('employee_id'))->exists()) && $batch->Enrolments->count() > 0 )

        <div class="mr-2 ml-2">
            {{-- <form action="{{ route('scores.retrieve') }}" method="post">
                <input type="hidden" name="batch_id" class="form-control" value="{{ $batch->id }}">
                <input type="hidden" name="academic_term_id" class="form-control" value="{{ $currentterm->id }}">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-success px-3 action_btn">Enter Score</button>
            </form> --}}
        </div>
        @endif
        @if (Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 3  ||  Auth::user()->Profile->role_id == 16 )
        <div class="mr-0 ml-3">
            @include('curriculummanagement::batchsubjects._bulksubjectsmodal')
            @include('enrolmentmanagement::enrolments._bulkenrolmentsmodal')
            @include('enrolmentmanagement::enrolments._enrolmentmodal')
        </div>
        @endif

    </ol>
</nav>

<div class="row mt-4">
    <div class="col-md-12">
        <h3>{{ $batch->label }} </h3>
        <p><strong>Enrolments: </strong>{{ $batch->Enrolments->count() }}</p>
        <p><strong>Subjects: </strong> <a href="{{ url('batches/subjects' , $batch) }}">{{ $batch->batchsubjects->count() }}</a></p>
    </div>
    <div class="col-md-9">

        <div class="main mt-4">
            <div class="card">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-people-tab" data-toggle="tab" href="#nav-people" role="tab" aria-controls="nav-people" aria-selected="false">Students</a>
                        <a class="nav-item nav-link" id="nav-subjects-tab" data-toggle="tab" href="#nav-subjects" role="tab" aria-controls="nav-subjects" aria-selected="false"> Subjects </a>
                    </div>
                </nav>
                <div class="card-body">
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                        <div class="tab-pane fade" id="nav-subjects" role="tabpanel" aria-labelledby="nav-subjects-tab">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="nav-box mb-3">
                                    @if($batch->BatchSubjects->count() < '1')
                                    <h5 class="text-danger mt-2">No subjects available for this class</h5>
                                    @else
                                    <h4>Subjects </h4>
                                    <hr>
                                        <table class="table" id="table">

                                            @include('curriculummanagement::batchsubjects._tablehead')
                                            <tbody>
                                                @foreach ($batch->BatchSubjects as $batchsubject)
                                                @include('curriculummanagement::batchsubjects._tabledata')
                                                @endforeach
                                            </tbody>
                                        </table>

                                    @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="nav-people" role="tabpanel" aria-labelledby="nav-people-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4> Students</h4>
                                    <hr>
                                    <div class="row">

                                        @if ($batch->Enrolments->count() < 1)
                                            <div class="col-md-12"><h5 class="text-center">No Client Enrolled yet</h5></div>
                                        @else
                                            @foreach($batch->Enrolments as $enrolment)
                                            <div class="col-md-2 col-sm-4 col-3 mb-2">
                                            @include('enrolmentmanagement::enrolments._single')
                                            </div>
                                            @endforeach
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

    <div class="col-md-3">
        <div class="box box-default">
            <div class="box-header ">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Class Officials</h5>
                    </div>
                    <div class="col-md-6">
                        @if(Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 3 || Auth::user()->Profile->role_id == 16 )
                        <a href="#assignofficial" class="btn btn-success px-3 btn-sm" data-toggle="modal" data-target="#assignofficial">
                            Add
                        </a>
                        @include('schoolmanagement::officials.createmodal')
                        @endif
                    </div>
                </div>

            </div>
            <div class="box-body">

                <div class="row">
                    @foreach ($batch->Officials as $official)
                        <div class="col-md-12 col-sm-6">
                            <div class="official-image text-center">
                            <img src="{{ asset($official->Employee->Profile->avatar) }}" alt="{{ $official->Employee->Profile->full_name}}'s picture" height="150px">
                                <p>{{ $official->Employee->Profile->full_name }} </p>
                                <h6 class="mb-3"> {{ $official->Employee->Designation->job_role }}</h6>

                                      @if (Auth::user()->Profile->role_id == 11|| Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 16)

                                        <form action="{{ route('officials.destroy',$official->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to remove this official from this class?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger px-3"> Remove</button>
                                        </form>

                                    @endif



                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>



@endsection
