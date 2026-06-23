@extends('layouts.admin')
@section('page_title', 'Manage Class' )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
  <div class="col-md-8 page_title">
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('levels/manage')}}" class="s-text16">
            Classes
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
            Manage
        </span>
    </div>
    <div class="col-md-4">
        <a href="{{ url('levels/create') }}" class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></a>
	</div>
</div>
<div class="row">
  <div class="col-md-8 page_title">
     	<h3> Classes </h3>
	</div>

</div>
    <div class="row">

        @foreach ($programs as $program)
        <div class="col-md-12 mb-3">
            <h6><a href="{{ route('programs.show', $program->tag) }}"> {{ $program->label }}</a> </h6>
            <div class="row">
                @foreach($program->Levels as $level)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="subject-card">
                            <div class="subject-header">
                                <div class="row">
                                    <div class="col-md-10 col-10 col-sm-10">
                                        <a href="{{ route('levels.show', $level->slug) }}">
                                            <h5>{{ $level->label}}   </h5>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-2 col-sm-2">
                                        <div class="dropdown">
                                            <a class="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="fa fa-navicon"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('levels.show', $level)}}">Details</a>
                                                <a class="dropdown-item" href="#edit{{$level->id}}" data-toggle="modal" data-target="#edit{{$level->id}}">Edit</a>
                                                @if($level->enabled == true)
                                                    <a class="dropdown-item" href="{{ url('levels/toggle', $level)}}">Disabled</a>
                                                    @else
                                                    <a class="dropdown-item" href="{{ url('levels/toggle', $level)}}">Enabled</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @include('catalogmanagement::levels._modal')
                                </div>
                            </div>
                            <div class="subject-body">
                                <div class="row">
                                    <div class="col-md-4 col-6 text-center text-primary">
                                        <h3>{{$level->ActiveStudents->count()}}</h3>
                                        <p> <b>Active Students</b> </p>
                                    </div>
                                    <div class="col-md-4 col-6 text-center text-danger">
                                        <h3>{{$level->InactiveStudents->count()}}</h3>
                                        <p> <b>Inactive Students</b> </p>
                                    </div>

                                    <div class="col-md-4 col-6 text-center text-danger">
                                        <h3>{{$level->Enrolments->count()}}</h3>
                                        <p> <b>Enrolments</b> </p>
                                    </div>

                                </div>
                            </div>
                            {{-- <div class="subject-footer text-left">
                                <div class="row">
                                    @if($level->ActiveStudents->count() > 0 )
                                    <div class="col-md-4">
                                        <a class="btn btn-primary btn-sm" href="{{ url('enrolbygrade', $level ) }}">Enrol Students</a>
                                    </div>
                                    @endif
                                        @if($level->is_terminal == true)
                                    <div class="col-md-8">

                                    @if($level->InactiveStudents->count() > 0)
                                    <form method="POST" action="{{ route('clients.activation') }}" id="BulkActivate">
                                        {{csrf_field()}}
                                        <input type="hidden" name="grade_id" value="{{ $level->id }}">
                                        <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}">

                                            <button class="btn btn-danger btn-sm" type="submit">Reactivate All Students</button>

                                    </form>
                                        @endif
                                    </div>
                                    @endif

                                </div>
                            </div> --}}
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

@endsection
@push('scripts')
<script>


</script>

 @endpush
