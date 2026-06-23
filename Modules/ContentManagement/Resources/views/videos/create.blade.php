@extends('layouts.admin')
@section('page_title', 'Add Gallery')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')
<div class="container-fluid">

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
			Add new Album
		</span>
  </div>

<div class="row">
  
        <div class="col-md-7 order-md-1">
          <h4 class="mb-3">Create Album</h4>
            <form method="POST" action="{{ route('albums.store') }}" id="CreateAlbum" enctype="multipart/form-data">
                {{csrf_field()}}
                
              @include('contentmanagement::albums._form')
                
                <hr class="mb-4">
                <button class="btn btn-success btn-lg" type="submit">Save </button>

            </form>
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

    $('#galleryable_type').on('change',function()  {
    var galleryable_type = $(this).val();
    if(galleryable_type){
      $.ajax({
        type:"GET",
        url:"{{url('gallery/get-galleryable-list')}}?galleryable_type="+galleryable_type,
        beforeSend: function()
        {
          $('#live_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){

            $("#galleryable").empty();

            $('#live_loading').css("visibility", "hidden");

            $.each(res,function(key,value)
            {
              $("#galleryable").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#galleryable").empty();
            }
          } });
    }else{
      $("#galleryable").empty();
    }
  });
  </script>

@endpush
