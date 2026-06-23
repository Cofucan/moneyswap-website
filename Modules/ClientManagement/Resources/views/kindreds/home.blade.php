@extends('layouts.client')
@section('page_title', $client->Admission->Profile->name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/subjectcategory.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush

@section('content')

<section class="dash-body">
  <div class="container-fluid">
    <div class="row m-b-20">
      <div class="col-md-12">
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
          <h4> <span class="strong">{{ $client->Person->name }}</span></h4>
        </div>
      </div>
      <div class="col-md-3 col-sm-5 order-md-2 order-sm-2">
        <div class="bg-ward mb-3">
          <a href="#" class="small-box-footer text-center"> <h5>{{ $client->Enrolment->Eligible->AcademicTerm->academic_term }}</h5></a>
          <div class="row">

            <div class="col-md-5 col-5">
              <img src="{{asset ($client->Person->getFirstMediaUrl('avatars'))}}" class="w-100"/>
            </div>
            <div class="col-md-7 col-7">

              <p><b>Client No:</b>{{ $client->Admission->admission_no }}</p>
              <p><b>Class:</b> {{ $client->Enrolment->Room->label }}</p>
              <p><b>Academic Group:</b> {{ $client->Stream->label}}</p>

            </div>
          </div>
        </div>
        <div class="small-box bg-white">
          <a href="#" class="box-header"> <h5 class="text-white"> Attendance</h5></a>
          <div class="inner">
            <div class="row">
              <div class="col-md-4 col-4 col-sm-4 text-center">
                <h3>{{$client->Enrolment->DaysPresent->count() }}</h3>
                <h6>Present</h6>
              </div>

              <div class="col-md-4 col-4 col-sm-4 text-center ">
                <h3>{{$client->Enrolment->DaysAbsent->count() }}</h3>
                <h6>Absent</h6>
              </div>

              <div class="col-md-4 col-4 col-sm-4 text-center">
                <h3>{{$client->Enrolment->DaysLate->count() }}</h3>
                <h6>Late</h6>
              </div>
            </div>

          </div>
          <div class="icon">
            <i class="fa fa-university"></i>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3 class="text-center">{{$client->Enrolment->EnrolmentSubjects->count()}}</h3>

              </div>
              <div class="icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <a href="#" class="small-box-footer"><h5>Subjects Enrolled</h5></a>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 class="text-center">{{$client->Enrolment->StudentAssignments->count()}}</h3>


              </div>
              <div class="icon">
                <i class="fa fa-file-text"></i>
              </div>
              <a href="#" class="small-box-footer"> <h5>Assignments Done</h5></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9 col-sm-7 order-md-1 order-sm-1">
        <div class="main mt-3">
          <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-virtualclassrooms-tab" data-toggle="tab" href="#nav-virtualclassrooms" role="tab" aria-controls="nav-virtualclassrooms" aria-selected="false">Live Classes</a>
              <a class="nav-item nav-link" id="nav-assignment-tab" data-toggle="tab" href="#nav-assignment" role="tab" aria-controls="nav-assignment" aria-selected="false">Assignments</a>
              {{-- <a class="nav-item nav-link" id="nav-lectures-tab" data-toggle="tab" href="#nav-lectures" role="tab" aria-controls="nav-people" aria-selected="false">Lectures</a> --}}
              <a class="nav-item nav-link" id="nav-subjects-tab" data-toggle="tab" href="#nav-subjects" role="tab" aria-controls="nav-people" aria-selected="false">My Subjects</a>
              <a class="nav-item nav-link" id="nav-quizzes-tab" data-toggle="tab" href="#nav-quizzes" role="tab" aria-controls="nav-people" aria-selected="false">Quizzes</a>
            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

            <div class="tab-pane fade" id="nav-assignment" role="tabpanel" aria-labelledby="nav-assignment-tab">
              <div class="row" >
                <div class="col-md-12">
                  <div class="nav-box mb-3">
                    <div class="row">
                      <div class="col-md-9">
                        <h4>Upcoming Assignment</h4>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        @if ($client->Enrolment->EnrolmentSubjects->count() > 0)
                        <div class="table-responsive-sm">
                          <table class="table w-100 table-bordered result" id="table">
                            <thead>
                            <tr>
                                <th>Assignment</th>
                                <th>Subject</th>
                                <th>Submission Deadline</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach($client->Enrolment->EnrolmentSubjects as $enrolmentSubject)
                              @foreach($enrolmentSubject->Subject->Assignments as $assignment)
                                <tr>
                                    <td> <a href="{{ route('assignments.preview', $assignment->id) }}">{{$assignment->label}} @if(!is_null($assignment->lesson_id)) - {{$assignment->Lesson->headline}} @endif <br>
                                       </a>
                                    </td>
                                  <td>{{$enrolmentSubject->Subject->SubjectCategory->title_name}}</td>

                                    <td>{{$assignment->submission_deadline}} </td>

                                    <td> <a class="btn btn-secondary btn-sm" href="{{ route('assignments.preview', $assignment->id) }}" data-toggle="tooltip" data-placement="top" title="Click to view details"> <i class="fa fa-eye" ></i> View Details</a> </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        @else
                        <h6 class="text-danger">Assignments not scheduled</h6>
                        @endif

                      </div>
                    </div>

                  </div>



                </div>
              </div>
            </div>

            {{-- <div class="tab-pane fade" id="nav-lectures" role="tabpanel" aria-labelledby="nav-lectures-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="nav-box mb-3">
                    <div class="row">
                        <div class="col-md-9">
                            <h4>Lectures Schedule</h4>
                        </div>

                    </div>
                    <hr>

                        @foreach($client->Enrolment->EnrolmentSubjects as $enrolmentSubject)

                            @foreach($enrolmentSubject->Subject->Lectures as $lecture)
                                <div class="col-md-12">
                                    <div class="subjectcategory-outline">
                                        <div class="row">
                                            <div class="col-md-10 col-sm-9">
                                                <h5>{{$lecture->SubjectTeacher->Subject->SubjectCategory->title_name}} <small>{{$lecture->Lesson->headline}}</small> </h5>
                                                {!!$lecture->summary!!} <br>

                                            </div>
                                            <div class="col-md-2 col-sm-3" id="show-more ">
                                              <a class="btn btn-secondary btn-sm" href="{{ route('lectures.preview', $lecture->id) }}" data-toggle="tooltip" data-placement="top" title="Click to view details"><i class="fa fa-eye" ></i> View Details </a>




                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @endforeach

                  </div>
                </div>
              </div>
            </div> --}}

              <div class="tab-pane fade" id="nav-subjects" role="tabpanel" aria-labelledby="nav-subjects-tab">
                <div class="row">
                  <div class="col-md-12">
                    <h5>Enrolment Subjects </h5>
                    <hr>
                    @if ($client->Enrolment->EnrolmentSubjects->isEmpty())
                    <h6 class="text-danger">No Scheduled Lecture</h6>
                    @else
                    <div class="table-responsive-sm">
                    <table class="table w-100" id="table">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th> Subject</th>
                          <th>Status</th>
                          <th> Total Assessment</th>
                          <th> Total Marks</th>
                          <th width="15%">Actions</th>
                      </tr>

                      </thead>
                      <tbody>
                          @foreach ($client->Enrolment->EnrolmentSubjects as $ensubject)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              <td><a  href="{{ route('enrolmentsubjects.show', $ensubject->id) }}">{{$ensubject->Subject->SubjectCategory->title_name }} - {{ $ensubject->Subject->code }} </a> </td>
                              <td> {{$ensubject->mandatory_status}}   </td>
                              <td>{{$ensubject->Marks->count() }}</td>
                              <td>{{$ensubject->Marks->sum('obtained') }}</td>
                              <td>
                                  <div class="row">

                                        <div class="col-md-3">
                                          <a href="{{ route('enrolmentsubjects.show', $ensubject->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                        </div>
                                       {{-- <div class="col-md-3">
                                        <a href="{{ url('studentassignments.create') }}" target="_blank" class="btn btn-success btn-sm">Submit Assignment</a>

                                       </div> --}}
                                      <div class="col-md-3">
                                          @if($ensubject->mandatory_status == 'Elective' && Auth::user()->profile->role_id == 10)
                                          <form action="{{ route('enrolmentsubjects.destroy',$ensubject->id) }}" method="post"
                                              onsubmit="return confirm('Are you sure you want to delete this subject?');">
                                              <input type="hidden" name="_method" value="DELETE" />
                                              {{ csrf_field() }}
                                              <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                          </form>
                                          @endif
                                      </div>

                                  </div>
                              </td>

                          </tr>
                          @endforeach
                      </tbody>

                  </table>

                    </div>
                    @endif
                  </div>
                </div>
              </div>

            <div class="tab-pane fade show active" id="nav-virtualclassrooms" role="tabpanel" aria-labelledby="nav-virtualclassrooms-tab">
              <div class="row">
                  <div class="col-md-12">
                      <div class="nav-box">
                          <div class="row">
                              <div class="col-md-9">
                                  <h4>Live Classes</h4>
                              </div>

                          </div>
                          <hr>
                          <div class="row">
                            @if ($client->Enrolment->EnrolmentSubjects->count() > 0)
                            <div class="col-md-12 table-responsive-sm">
                              <table class="table w-100 table-bordered result" id="table">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th> Date /Time</th>
                                    <th>Lesson</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($client->Enrolment->EnrolmentSubjects as $enrolmentSubject)
                                    @foreach($enrolmentSubject->Subject->UpcomingVirtualClassroom as $virtualclassroom)
                                    <tr>
                                    <td>{{$enrolmentSubject->Subject->SubjectCategory->title_name}}</td>
                                    <td>{{$virtualclassroom->go_live}} - {{$virtualclassroom->start_time}}</td>
                                    <td>
                                      <a href="{{ route('virtualclassrooms.preview', $virtualclassroom->id) }}">{{$virtualclassroom->label}}
                                      </a>
                                    </td>
                                    <td>
                                      @include('virtualclassrooms._join')
                                    </td>
                                    </tr>
                                    @endforeach
                                  @endforeach
                                </tbody>
                            </table>
                            </div>

                            @else
                            <h6 class="text-danger">Class Not Scheduled</h6>
                            @endif
                          </div>



                      </div>
                  </div>
              </div>
          </div>

            <div class="tab-pane fade" id="nav-quizzes" role="tabpanel" aria-labelledby="nav-quizzes-tab">
              <div class="row">
                <div class="col-md-12">
                  <h5>Quizzes</h5>
                  <hr>
                  @if ($client->Enrolment->EnrolmentSubjects->count() > 0)
                  <div class="table-responsive-sm">
                    <table class="table w-100 table-bordered result" id="table">
                      <thead>
                      <tr>
                          <th>Scheduled Date</th>
                          <th>Quiz </th>
                          <th>Subject</th>
                          <th></th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($client->Enrolment->EnrolmentSubjects as $enrolmentSubject)
                        @foreach($enrolmentSubject->Subject->ApprovedQuizzes as $quiz)
                          <tr>
                            <td>{{$quiz->scheduled_datetime}} </td>
                            <td> {{$quiz->label}} </td>
                            <td>{{$enrolmentSubject->Subject->SubjectCategory->title_name}}</td>
                            <td>


                                  @if ( Carbon\Carbon::today()->toDateString() == $quiz->effective_date && $quiz->status == 'Approved')
                                  <form method="POST" action="{{ route('quizzes.start') }}" id="StartQuiz">
                                      {{csrf_field()}}
                                      <input type="hidden" name="quiz_id" value="{{ $quiz->id }}" class="form-control" />
                                      <input type="hidden" name="enrolment_subject_id" value="{{ $enrolmentSubject->id }}" class="form-control" />
                                      <button class="btn btn-success btn-block btn-sm" type="submit" >View </button>
                                    </form>
                                @endif

                            </td>
                          </tr>
                          @endforeach
                          @endforeach
                      </tbody>
                  </table>
                  </div>
                  @else
                  <h6 class="text-danger">No Test Scheduled for you</h6>
                  @endif
                  </div>
              </div>
            </div>



        </div>
      </div>

        {{-- <div class="row">
          <div class="col-md-4">
            <div class="menu-left">
              <h5>Upcoming Lessons</h5>
              <hr>
              <ul>

                  @if ($upcomingassignments->count() !== 0)
                    @foreach($upcomingassignments as $assignment)
                     <li><a href="{{ route('assessments.preview',$assignment->id) }}" class="featured-job">
                        {{  $assignment->assignment_title }})
                    </a> </li>
                    @endforeach
                    @else
                    <h6 class="text-danger">No Upcoming Assignment</h6>
                  @endif


              </ul>

            </div>
          </div>
          <div class="col-lg-4 col-md-4  col-sm-6 ">
            <div class="menu-left">
              <h5>Pening Assignments</h5>
              <hr>
              <ul>

                  @if ($upcomingassignments->count() !== 0)
                    @foreach($upcomingassignments as $assignment)
                     <li><a href="{{ route('assessments.preview',$assignment->id) }}" class="featured-job">
                        {{  $assignment->assignment_title }})
                    </a> </li>
                    @endforeach
                    @else
                    <h6 class="text-danger">No Upcoming Assignment</h6>
                  @endif


              </ul>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-md-4  col-sm-6 ">
            <div class="menu-left">
              <h5>Class Schedule</h5>
              <hr>
              <ul>

                  @if ($upcomingassignments->count() !== 0)
                    @foreach($upcomingassignments as $assignment)
                     <li><a href="{{ route('assessments.preview',$assignment->id) }}" class="featured-job">
                        {{  $assignment->assignment_title }})
                    </a> </li>
                    @endforeach
                    @else
                    <h6 class="text-danger">No Upcoming Assignment</h6>
                  @endif


              </ul>

            </div>
          </div>
          <!-- ./col -->

        </div> --}}
      </div>

    </div>
  </div>
</section>

@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>

@endpush
