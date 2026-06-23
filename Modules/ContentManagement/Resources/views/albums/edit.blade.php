@extends('layouts.admin')
@section('page_title', $program->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="{{ url ('studio/manage')}}" class="s-text16">
			Albums
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			Edit 
		</span>
  </div>

<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Section </h4>
            <form action="{{ route('galleries.update', $program->id) }}" method="POST"  id="UpdateSection" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')

                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="galleryable_type"> Where to add gallery</label>
                        <select name="galleryable_type" class="custom-select d-block w-100 select2" id="galleryable_type" required>
                            <option>Choose one </option>
                            <option  value="event">Event</option>
                            <option  value="page">Page</option>
                            <option  value="school">School</option>
                            <option  value="activity">Activity</option>
                        </select>
                        @if ($errors->has('galleryable_type'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('galleryable_type') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="galleryable_id"> Section Item</label>
                        <select name="galleryable_id" class="custom-select d-block w-100 select2" id="galleryable_id" required>

                        </select>
                        <span id="live_loading"><i class="fa fa-spinner  fa-spin"></i></span>
                        @if ($errors->has('galleryable_id '))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('galleryable_id ') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="label"> Title</label>
                    <input type="text" name="label" value="{{ $program->label }}" class="form-control" placeholder="Enter program title"  id="label" />
                    @if ($errors->has('label'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group ">
                    <label for="overview">Overview</label>
                    <textarea name="overview" class="form-control" rows="5">
                        {!! $program->overview !!}
                    </textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <img src="{{ asset ($program->thumbnail) }}" alt="{{$program->label }}" height="70%">
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="display_image">Display Image</label>
                            <input type="file" name="display_image" value="{{old('display_image')}}" class="form-control" placeholder="Upload  Image"  id="display_image" />
                            @if ($errors->has('display_image'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('display_image') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="target_url"> Target URL</label>
                            <input type="text" name="target_url" value="{{ $program->target_url }}" class="form-control" placeholder="Target URL"  id="target_url" />
                            @if ($errors->has('target_url'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('target_url') }}</strong>
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



                        <div class="col-md-12 p-t-20">
                            <img src="{{ asset ($program->thumbnail) }}" alt="{{$program->label }}" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script>
    CKEDITOR.replace("overview",
        {
            height: 120
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function()
 {
   $('.select2').select2();
  }
  );
  $('#galleryable_type').on('change',function()
{
  var galleryable_type = $(this).val();
  if(galleryable_type){
    $.ajax({
      type:"GET",
      url:"{{url('galleries/get-galleryable_id-list')}}?galleryable_type="+galleryable_type,
      beforeSend: function()
      {
        $('#live_loading').css("visibility", "visible");
      },
      success:function(res){
        if(res){

          $("#galleryable_id").empty();

          $('#live_loading').css("visibility", "hidden");

          $.each(res,function(key,value)
          {
            $("#galleryable_id").append('<option value="'+key+'">'+value+'</option>'); });
          }else
          {
            $("#galleryable_id").empty();
          }
        } });
  }else{
    $("#galleryable_id").empty();
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
