@extends('layouts.admin')
@section('page_title', 'Add Subject to Batch')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
    #loading{
        visibility: hidden;
    }
</style>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>

            <li class="breadcrumb-item"> <a href="{{ route('batches.show', $batch) }}">{{ $batch->label }}</a></li>

            <li class="breadcrumb-item active" aria-current="page">Add Subject to Batch</li>

        </ol>
    </nav>
      <div class="row">

        <div class="col-md-6">
          <h4 class="mb-3">Add Subject to Batch</h4>
          <p> Use this form to add subjects to class arms or batch </p>
          <div class="card">
            <div class="form-card">
                <form method="POST" action="{{ route('batchsubjects.bulkstore') }}" id="CreateBatchSubject">
                    {{csrf_field()}}


                    <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                    <h4>{{ $batch->label }} </h4>
                    <div class="form-group">
                      <label for="subject_category_id">Subjects </label>
                      <select id="subjectcategories" class="select2 form-control" name="subjectcategories[]" multiple="multiple" data-live-search="true" >
                        <option value="">Select subjects</option>
                        @foreach($batch->Level->Program->subjectcategories as $subject)
                                <option value="{{$subject->id}}">{{$subject->title_name}}</option>
                          @endforeach
                      </select>
                      @if ($errors->has('subject_category_id'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('subject_category_id') }}</strong>
                          </span>
                      @endif
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-success" type="submit">Add </button>

                </form>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <h5>Existing Subjects</h5>
          <ul>
            @foreach ($batch->batchsubjects as $subject)
                <li>{{ $subject->label}}</li>
            @endforeach
          </ul>
        </div>
      </div>
@endsection



@push('scripts')

@endpush
