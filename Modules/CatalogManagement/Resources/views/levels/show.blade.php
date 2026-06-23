@extends('layouts.admin')
 @section('page_title', $level->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">
@endpush
@section('content')


    <div class="container">
        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>

                <li class="breadcrumb-item"> <a href="{{ url ('levels/manage')}}">  Classes</a></li>

                <li class="breadcrumb-item active" aria-current="page">{{ $level->label }}</li>
                <div class="ml-auto mr-0">
                @if (Auth::user()->Profile->role_id == 14|| Auth::user()->Profile->role_id == 3)
                    <a href="{{ url('invoices/level', $level) }}" class="btn btn-primary px-3 btn-sm">
                        Client BIll
                    </a>
                     {{-- @include('grademanagement::levels._bulkenrol') --}}
                @endif


                </div>
            </ol>
        </nav>

        <div class="row">
                <div class="col-md-6 content_title">
                    <h5>  {{ $level->label }} </h5>
                </div>
        </div>

    <div class="row mt-1">
        <div class="col-md-12 mt-2">
            <table class="table table-bordered">
                <tr>
                    <td> <strong>Students:</strong> {{ $level->ActiveStudents->count() }}</td>
                    <td><strong>Previous Class:</strong> {{$level->previous}}</td>
                </tr>
            </table>

            <div class="main mt-4">
                <div class="card">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-people-tab" data-toggle="tab" href="#nav-people" role="tab" aria-controls="nav-people" aria-selected="false">Students</a>
                            <a class="nav-item nav-link" id="nav-batches-tab" data-toggle="tab" href="#nav-batches" role="tab" aria-controls="nav-batches" aria-selected="false">Arms </a>
                            <a class="nav-item nav-link" id="nav-subjects-tab" data-toggle="tab" href="#nav-subjects" role="tab" aria-controls="nav-subjects" aria-selected="false"> Term Subjects </a>
                        </div>
                    </nav>
                    <div class="card-body">
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                            <div class="tab-pane fade" id="nav-subjects" role="tabpanel" aria-labelledby="nav-subjects-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="nav-box mb-3">
                                            @if($level->subjects->count() < '1')
                                            <h5 class="text-danger mt-2">No subjects available for this class</h5>
                                            @else
                                                <h4>Subjects </h4>
                                                <hr>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Subjects</th>
                                                            <th>Assigned Teacher</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($level->subjects->where('term_id', $currentterm->term_id) as $subject)
                                                            <tr>
                                                                <td>{{ $subject->label }}</td>
                                                                <td>@if (!is_null($subject->SubjectTeacher))
                                                                        {{ $subject->SubjectTeacher->Employee->Profile->full_name }}
                                                                            @else
                                                                            No Teacher Assigned yet
                                                                    @endif
                                                                </td>
                                                            </tr>
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

                                            @if ($level->Enrolments->count() < 1)
                                                <div class="col-md-12"><h5 class="text-center">No Client Enrolled yet</h5></div>
                                            @else
                                                @foreach($level->Enrolments as $enrolment)
                                                <div class="col-md-2 col-sm-4 col-3 mb-2">
                                                @include('enrolmentmanagement::enrolments._single')
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-batches" role="tabpanel" aria-labelledby="nav-batches-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="nav-box mb-3">
                                            @if($level->Batches->count() < '1')
                                            <h5 class="text-danger mt-2">No Batch available for this class</h5>
                                            @else
                                                <h4>Batches </h4>
                                                <table class="table w-100" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th >#</th>

                                                            <th >Label</th>

                                                            <th >Compulsory Subjects </th>
                                                            <th >Electives</th>
                                                            <th  width="20%">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($level->Batches as $batch)
                                                        <tr>
                                                            <td>{{$loop->iteration }}</td>
                                                            <td>{{$batch->label}}</td>
                                                            <td>{{$batch->compulsory_subjects }}</td>
                                                            <td>{{$batch->elective_subjects }}</td>
                                                            <td>
                                                                <div class="row no-gutters">
                                                                    <div class="col-md-9">
                                                                        <a class="btn btn-secondary btn-sm px-3" href="{{ route('batches.show', $batch) }}">Details</a>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <form action="{{ route('batches.destroy',$batch) }}" method="post"
                                                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                                            <input type="hidden" name="_method" value="DELETE" />
                                                                            {{ csrf_field() }}
                                                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

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



    </div>


@endsection
@push('scripts')


@endpush
