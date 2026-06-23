@extends('layouts.admin')
@section('page_title', $announcement->headline)
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

            <a href="{{ url ('sections/manage')}}" class="s-text16">
               Announcements
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Edit [{{$announcement->headline}}]
            </span>
        </div>
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Announcement </h4>
            <form action="{{ route('announcements.update', $announcement->id) }}" method="POST"  id="UpdateAnnouncement" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
 

                <div class="form-group">
                    <label for="headline"> Subject</label>
                    <input type="text" name="headline" value="{{ $announcement->headline }}" class="form-control{{ $errors->has('headline') ? ' is-invalid' : '' }}" placeholder="Enter program title"  id="headline" />
                    @if ($errors->has('headline'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('headline') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group ">
                    <label for="announcement_body">Announcement Body</label>
                    <textarea name="announcement_body" class="form-control {{ $errors->has('announcement_body') ? ' is-invalid' : '' }}" rows="5">
                        {!! $announcement->announcement_body !!}
                    </textarea>
                    @if ($errors->has('announcement_body'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('announcement_body') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <label for="action_button"> Action Button</label>
                    </div>
                    <div class="col-md-6 input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">Text</div>
                        </div>
                        <input type="text" name="action_text" value="{{ old ('action_text')}}" class="form-control{{ $errors->has('action_text') ? ' is-invalid' : '' }}"/>
                        @if ($errors->has('action_text'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('action_text') }}</strong>
                            </span>
                        @endif
                    </div>
            
                    <div class="col-md-6 input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">Link</div>
                        </div>
                        <input type="text" name="action_url" value="{{ old ('action_url')}}" class="form-control{{ $errors->has('action_url') ? ' is-invalid' : '' }}"/>
                        @if ($errors->has('action_url'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('action_url') }}</strong>
                            </span>
                        @endif
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
                <div class="box-announcement_body">
                    <div class="row">

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-desktop"></i>
                                Status:
                                <b>
                                        @if($announcement->published == 1)
                                        <span class="enable">Published</span>
                                        @else
                                        <span class="disable"> Not Published</span>
                                        @endif
                                </b>

                        </div>

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-clock-o"></i>
                                Last Updated: <b>{{ $announcement->publish_date }}</b></p>
                        </div>

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-clock-o"></i>
                                Section Type: <b>{{ $announcement->page_views }}</b></p>
                        </div>

                        <div class="col-md-12 p-t-20">
                            <img src="{{ asset ($announcement->thumbnail) }}" alt="{{$announcement->headline }}" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script>
    CKEDITOR.replace("announcement_body",
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
  $('#section_tenure').on('change',function()
{
  var section_tenure = $(this).val();
  if(section_tenure){
    $.ajax({
      type:"GET",
      url:"{{url('sections/get-sectionable-list')}}?section_tenure="+section_tenure,
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
 