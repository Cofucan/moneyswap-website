@extends('layouts.admin')
@section('page_title', 'Add Guideline')
@push('styles')
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{route ('portals.show', $portal->id) }}">School Details</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Policy</li>
        <div class="ml-auto mr-0">
            
        </div>
    </ol>
</nav>

    <div class="row">
           
            <div class="col-md-9 order-md-1">
                <h4 class="mb-3">Add New Policy</h4>
                <p>Use the form below to enter new policy</p>
                <hr>
                <form method="POST" action="{{ route('guidelines.store') }}" id="CreateGuideline" >
                    {{csrf_field()}}
                    <input type="hidden" name="organization_id" class="form-control" value="{{ $portal->organization_id}}">

                    <div class="form-group">
                        <label for="label">Policy Title <span class="required">*</span></label>
                        <input type="text" name="label" value="{{old('label')}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Add Guideline Title"  id="label" required/>
                        @if ($errors->has('label'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="overview">Policy Details <span class="required">*</span></label>
                        <textarea name="overview" class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}" rows="7" placeholder="Add Policy Details" id="textarea">{{old('overview')}}</textarea>
                        @if ($errors->has('overview'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('overview') }}</strong>
                            </span>
                        @endif
                    </div>


                    <hr class="mb-4">
                    <button class="btn btn-success" type="submit">Save </button>

                </form>
            </div>
    </div>

@endsection
@push('scripts')
<script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#textarea').summernote({
    tabsize: 2,
    height: 400,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>
@endpush
