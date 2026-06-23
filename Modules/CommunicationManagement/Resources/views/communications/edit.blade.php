@extends('layouts.admin')
@section('page_title', 'Add Entrance Exam')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}"> 
<link rel="stylesheet" href="{{ asset ('css/hide.css') }}"> 
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}"> 
@endpush
@section('content')

<div class="container-fluid">
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Existing Entrance Exams</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">                               
            <ul>
                <li><a href="{{url ('/')}}">Literary & Debate Stream</a></li>
                <li><a href="{{url ('/')}}">Boys Scout/Girls Guild</a></li>
                <li><a href="{{url ('/')}}">Press Club</a></li>
            </ul>                   
        </div>
           
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Entrance Exam </h4>
          <form method="POST" action="{{ route('events.store') }}" id="CreateEvent"  enctype="multipart/form-data">
                {{csrf_field()}}  

                 <div class="form-group">
                    <label for="subject_id"> Exam Subjects</label>
                    <select id="subject_id" name="subject_id" class="form-control select2" value="{{$exntranceexam->subject_id}}" multiple="mutiple" data-live-search="true" >
                              <option>Select subjects</option>
                              <option>Mathematics</option>
                              <option>English</option>
                          </select>
                    @if ($errors->has('subject_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('subject_id') }}</strong>
                        </span>
                    @endif                   
                </div>

                <div class="form-group">
                    <label for="school_id"> School</label>
                    <select id="school_id" name="school_id" value="{{ $entranceexam->school_id }}" class="form-control select2" data-live-search="true" >
                              <option>Select </option>
                              <option>College</option>
                              <option>Primary</option>
                          </select>
                    @if ($errors->has('school_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('school_id') }}</strong>
                        </span>
                    @endif                   
                </div>

                <div class="form-group">
                    <label for="max_score"> Maximum Scoresheet</label>
                    <input type="number" name="max_score" value="{{ $entranceexam->max_score}}" class="form-control" placeholder="Maximum score"  id="max_score" />
                    @if ($errors->has('max_score'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('max_score') }}</strong>
                        </span>
                    @endif                   
                </div>

                <div class="form-group">
                    <label for="pass_mark">Pass Mark</label>
                    <input type="number" name="pass_mark" value="{{ $entranceexam->pass_mark }}" class="form-control" placeholder="Pass Mark"  id="pass_mark" />
                    @if ($errors->has('pass_mark'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('pass_mark') }}</strong>
                        </span>
                    @endif                   
                </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>
                
            </form>
        </div>  
</div>
</div>

  
@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function(){
      $('.select2').select2();
    });
</script>

@endpush