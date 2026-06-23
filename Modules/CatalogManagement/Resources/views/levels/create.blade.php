@extends('layouts.admin')
@section('page_title', 'Add Class')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<div class="container-fluid">

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('levels/manage')}}" class="s-text16">
        Levels
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        Create
    </span>
</div>
    <div class="row">
        <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Info</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Class </h4>
          All fields marked with <span class="required">*</span> are required
          <hr>
          <form method="POST" action="{{ route('levels.store') }}" id="CreateLevel" enctype="multipart/form-data">
            {{csrf_field()}}

                <div class="form-group">
                    <label for="program_id">Program <span class="required">*</span></label>
                    <select class="custom-select d-block w-100 select2{{ $errors->has('program_id') ? ' is-invalid' : '' }}"  name="program_id" id="program_id" required>
                            <option value=""> Select Program</option>
                            @foreach($programs as $key => $program)
                            @if(old('program_id') == $key)
                            <option value="{{$key}}" selected> {{$program}}</option>
                             @else
                             <option value="{{$key}}"> {{$program}}</option>
                             @endif
                         @endforeach
                    </select>
                    @if ($errors->has('program_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('program_id') }}</strong>
                        </span>
                    @endif
                </div>

                  @include('catalogmanagement::levels._form')

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>

            </form>
        </div>
</div>
</div>




@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
         jQuery(document).ready(function($) {{
            $('.select2').select2();

          });
      </script>
<script>
    CKEDITOR.replace("overview",
        {
            height: 120,
            // Define the toolbar streams as it is a more accessible solution.
         toolbarGroups: [{
          "name": "basicstyles",
          "streams": ["basicstyles"]
        },
        {
          "name": "links",
          "streams": ["links"]
        },
        {
          "name": "paragraph",
          "streams": ["list", "blocks"]
        },
        {
          "name": "document",
          "streams": ["mode"]
        },
        {
          "name": "insert",
          "streams": ["insert"]
        },
        {
          "name": "styles",
          "streams": ["styles"]
        },
        {
          "name": "about",
          "streams": ["about"]
        }
      ],
      // Remove the redundant buttons from toolbar streams defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });
</script>
@endpush

