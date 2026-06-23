@extends('layouts.admin')
@section('page_title', 'Edit Requirement')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')

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
      Edit Requirement
    </span>
</div>
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Requirement </h4>
            <form action="{{ route('requirements.update', $requirement->id) }}" method="POST"  id="UpdateRequirement">
                {{csrf_field()}}
                @method('PUT')

                <div class="form-group">
                    <label class="control-label" for="school_class_id">Section</label>
                    <select name="program_id" class="custom-select d-block select2" value="{{ $requirement->program_id }}" id="program_id" required>
                        @foreach($sections as $key => $program)
                        @if($requirement->program_id == $key)
                        <option selected value="{{$key}}"> {{$program}}</option>
                        @else
                        <option value="{{$key}}"> {{$program}}</option>
                        @endif
                    @endforeach
                    </select>
                    @if ($errors->has('program_id'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('program_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="control-label" for="requirement">Requirement</label>
                    <textarea name="requirement" value="{{ $requirement->requirement }}" class="form-control" rows="2" placeholder="Requirement Description">
                    {!! $requirement->requirement !!}</textarea>
                    @if ($errors->has('requirement'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('requirement') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="published" checked>
                    <label class="custom-control-label" for="published">Published</label>
                </div>


                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>


        </div>

        <div class="col-md-3 offset-md-1">
            <div class="box box-collapsed">
                <div class="box-header text-center">
                    <h5>Requirement Info</h5>
                </div>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-desktop"></i>
                                Status:
                                <b>
                                        @if($requirement->published == 1)
                                        <span class="enable">Published</span>
                                        @else
                                        <span class="disable"> Not Published</span>
                                        @endif
                                </b>
                                </p>
                          
                        </div>

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-bandcamp"></i>
                                Section: <b>{{ $requirement->Section->section_name }}</b></p>

                        </div>
                        <div class="col-md-12 publish-form">
                                <p><i class="fa fa-clock-o"></i>
                                    Last Updated: <b>{{ $requirement->updated_at }}</b></p>

                            </div>

                    
                    </div>
                </div>
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
