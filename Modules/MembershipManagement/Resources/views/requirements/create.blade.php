@extends('layouts.admin')
@section('page_title', 'Add Member Requirement')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')

<div class="container-fluid">

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('requirements/manage')}}" class="s-text16">
       Member Requirement
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
       Add Requirement
    </span>
</div>

<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Instructions</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">
            <ol>
                <li>Select a school</li>
                <li>Enter requirement</li>
                <li>Click Save button to add the requirement</li>

            </ol>
        </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Member Requirement</h4>
            <form action="{{ route('requirements.store') }}" method="POST"  id="CreateRequirement" >
            {{csrf_field()}}

                <div class="form-group">
                    <label class="control-label" for="program_id">Section</label>
                    <select class="custom-select d-block w-100 select2"  name="program_id" id="school" required>
                        <option value=""> Select program</option>
                        @foreach($sections as $key => $program)
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

                <div class="form-group">
                    <label class="control-label" for="requirement">Member Requirement</label>
                    <textarea name="requirement" class="form-control{{ $errors->has('requirement') ? ' is-invalid' : '' }}" rows="2" placeholder="requirement">
                        {!! old('requirement') !!}
                    </textarea>
                    @if ($errors->has('requirement'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('requirement') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="published" value="1" checked>
                    <label class="custom-control-label" for="published">Published</label>
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
<script>
    CKEDITOR.replace( 'requirement' );
</script>
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script>
  $(document).ready(function(){
      $('.select2').select2();
  });
</script>

@endpush
