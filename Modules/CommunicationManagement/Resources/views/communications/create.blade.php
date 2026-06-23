@extends('layouts.admin')
@section('page_title', 'Performance Feedback')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>
        <a href="{{ url ('communications/manage')}}" class="s-text16">
           Activity Feedback
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>
        <span class="s-text17">
            Compose communication Note
        </span>
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-1 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                Info
            </h4>
        <div class="page-menu">
            {{--  <ul>
                <li><a href="{{url ('/')}}">First Term</a></li>
            </ul>  --}}
        </div>


        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">{{ $client->Person->name }} Activities feedback Log</h4>
            <form method="POST" action="{{ route('communications.store') }}" id="CreateFeedback" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}" class="form-control" />
                <input type="hidden" name="pupil_id" value="{{ $client->id }}" class="form-control" />
                <div class="form-group">
                    <label for="pupil_id"> Client</label>
                    {{ $client->Person->candidate_name }}
                </div>

                <div class="form-group">
                    <label for="activity_type">Activity Type</label>
                    <select class="custom-select d-block w-100 select2{{ $errors->has('activity_type') ? ' is-invalid' : '' }}"  name="activity_type" id="activity_type" required>
                    <option value=""> Select Activity</option>
                    @foreach($activityTypes as $activityType)
                            @if(old('activity_type') == $activityType)
                            <option value="{{$activityType}}" selected>{{$activityType}}</option>
                                @else
                            <option value="{{$activityType}}">{{ $activityType }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('activity_type'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('activity_type') }}</strong>
                         </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="subject"> Subject</label>
                    <input type="text" name="subject" value="{{old('subject')}}" class="form-control" placeholder="Enter Client Log title"  id="subject" />
                    @if ($errors->has('subject'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group ">
                    <label for="details">Details</label>
                    <textarea name="details" class="form-control">
                        {!! old('details') !!}
                    </textarea>
                    @if ($errors->has('details'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('details') }}</strong>
                        </span>
                    @endif
                </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Cancel</button>

            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')

    <script src="{{ asset('js/select2.full.min.js')}}"></script>
    <script>
     jQuery(document).ready(function($) {
        $('.select2').select2();

        CKEDITOR.replace( 'details' );
        });
    </script>
@endpush
