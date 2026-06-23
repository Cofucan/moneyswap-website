@extends('layouts.admin')
@section('page_title', $program->section_name)
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

            <a href="{{ url ('programs/manage')}}" class="s-text16">
                Sections
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Edit [{{$program->section_name}}]
            </span>
        </div>
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Section </h4>
            <form action="{{ route('programs.update', $program->id) }}" method="POST"  id="UpdateSection" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')

                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="section_tenure"> Where to add Section</label>
                        <select name="section_tenure" class="custom-select d-block w-100 select2 {{ $errors->has('section_tenure') ? ' is-invalid' : '' }}" id="section_tenure" required>
                                @foreach($sectionableTypes as $key => $section_tenure)
                                @if($program->section_tenure == $key)
                                <option value="{{$key}}" selected> {{$section_tenure}}</option>
                                    @else
                                    <option value="{{$key}}"> {{$section_tenure}}</option>
                                    @endif
                                @endforeach
                        </select>
                        @if ($errors->has('section_tenure'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('section_tenure') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="sectionable_id"> Section Item</label>
                        <select name="sectionable_id" class="custom-select d-block w-100 select2{{ $errors->has('sectionable_id') ? ' is-invalid' : '' }}" id="sectionable" required>

                        </select>
                        <span id="live_loading"><i class="fa fa-spinner  fa-spin"></i></span>
                        @if ($errors->has('sectionable_id '))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('sectionable_id ') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="section_name"> Title</label>
                    <input type="text" name="section_name" value="{{ $program->section_name }}" class="form-control{{ $errors->has('section_name') ? ' is-invalid' : '' }}" placeholder="Enter program title"  id="section_name" />
                    @if ($errors->has('section_name'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('section_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group ">
                    <label for="section_description">Overview</label>
                    <textarea name="section_description" class="form-control {{ $errors->has('section_description') ? ' is-invalid' : '' }}" rows="5">
                        {!! $program->section_description !!}
                    </textarea>
                    @if ($errors->has('section_description'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('section_description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <img src="{{ asset ($program->thumbnail) }}" alt="{{$program->section_name }}" height="70%">
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="display_image">Display Image</label>
                            <input type="file" name="display_image" value="{{old('display_image')}}" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}" placeholder="Upload  Image"  id="display_image" />
                            @if ($errors->has('display_image'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('display_image') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="graduation_qualification"> Target URL</label>
                            <input type="text" name="graduation_qualification" value="{{ $program->graduation_qualification }}" class="form-control{{ $errors->has('graduation_qualification') ? ' is-invalid' : '' }}" placeholder="Target URL"  id="graduation_qualification" />
                            @if ($errors->has('graduation_qualification'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('graduation_qualification') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>




                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>


        </div>

        <div class="col-md-3 offset-md-1">
            <div class="box box-collapsed">
                <div class="box-header text-center">
                    <h5>Publish</h5>
                </div>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-desktop"></i>
                                Status:
                                <b>
                                        @if($program->published == 1)
                                        <span class="enable">Published</span>
                                        @else
                                        <span class="disable"> Not Published</span>
                                        @endif
                                </b>

                        </div>

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-clock-o"></i>
                                Last Updated: <b>{{ $program->updated_at }}</b></p>
                        </div>

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-clock-o"></i>
                                Section Type: <b>{{ $program->section_tenure }}</b></p>
                        </div>

                        <div class="col-md-12 p-t-20">
                            <img src="{{ asset ($program->thumbnail) }}" alt="{{$program->section_name }}" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script>
    CKEDITOR.replace("section_description",
        {
            height: 120
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
 {
   $('.select2').select2();
  }
  );
  $('#section_tenure').on('change',function()
{
  var section_tenure = $(this).val();
  if(section_tenure){
    $.ajax({
      type:"GET",
      url:"{{url('programs/get-sectionable-list')}}?section_tenure="+section_tenure,
      beforeSend: function()
      {
        $('#live_loading').css("visibility", "visible");
      },
      success:function(res){
        if(res){

          $("#sectionable").empty();

          $('#live_loading').css("visibility", "hidden");

          $.each(res,function(key,value)
          {
            $("#sectionable").append('<option value="'+key+'">'+value+'</option>'); });
          }else
          {
            $("#sectionable").empty();
          }
        } });
  }else{
    $("#sectionable").empty();
  }
});
</script>

<script>


  function showDescription() {
      document.getElementById("Description").style.display = "block";
  }

  function closeDescription() {
      document.getElementById("Description").style.display = "none";
  }

</script>
@endpush
