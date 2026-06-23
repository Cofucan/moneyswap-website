@extends('layouts.admin')
@section('page_title', $level->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('levels/manage')}}" class="s-text16">
        Class
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        Edit [{{$level->label}}]
    </span>
</div>
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Class </h4>
            <form action="{{ route('levels.update', $level) }}" method="POST"  id="UpdateLevel" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                <div class="form-group">
                    <label for="label">Class Name</label>
                    <input type="text" name="label" value="{{$level->label }}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}"  id="label" />
                    @if ($errors->has('label'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="program_id">Program</label>
                    <input type="text"  value="{{$level->label }}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}"  id="label" readonly/>

                    @if ($errors->has('program_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('program_id') }}</strong>
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
<script>
    CKEDITOR.replace("remarks",
        {
            height: 120
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
         jQuery(document).ready(function($) {{
            $('.select2').select2();

          });
      </script>


@endpush
