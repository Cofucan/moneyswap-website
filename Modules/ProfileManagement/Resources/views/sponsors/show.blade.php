@extends('layouts.admin')
 @section('page_title', $sponsor->Person->name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

    <div class="container">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <a href="{{ url ('sponsors/manage')}}" class="s-text16">
                Sponsor
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                {{$sponsor->label}}
            </span>
        </div>
    <div class="row">
  <div class="col-md-8 content_title">
     	<h4 class="mb-4">  {{ $sponsor->label }} </h4>
         <div class="form-group mt-3">
           
        </div>
	</div>
  <div class="col-md-4">

	  <div class="page_button">
      <a href="{{ url('sponsors/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
        {{--  <a href="{{ url('sponsors/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>  --}}
        <a class="btn btn-primary btn-sm" href="{{ route('sponsors.edit',$sponsor->id) }}"><i class="fa fa-pencil"></i> Edit</a>
        

	  </div>
	</div>
</div>

<div class="row details">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered">
            <tr>
                <td>
                    <strong>Academic Term :</strong>
                    {{ $sponsor->AdmissionSchedule->AcademicTerm->academic_term }}
                </td>
                <td>
                    <strong>Duration: </strong>
                    {{$sponsor->duration_minutes}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong> Total Mark: </strong>
                    {{$sponsor->total_marks}}
                </td>
                <td>
                    <strong> Pass Mark: </strong>
                    {{$sponsor->pass_mark}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Start Date:</strong>
                    {{$sponsor->screening_datetime}}
                </td>
                <td>
                    <strong>End Date:</strong>
                    {{$sponsor->result_available_at}}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <strong>Sponsor Details</strong><br>
                  <span>{!! $sponsor->details !!}</span> 
                </td>
            </tr>
        </table>

        <ul class="no-bullet">
            <strong>Participating Section</strong><br>
                @foreach ($sponsor->Sections as $program)
                <li> {{$program->section_name }} </li>
                @endforeach
            </ul>
    </div>
            
    </div>

@endsection
