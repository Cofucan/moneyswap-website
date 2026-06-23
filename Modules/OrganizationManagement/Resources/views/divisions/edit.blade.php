@extends('layouts.admin')
@section('page_title', $division->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Section </h4>
            <form method="POST" action="{{ route('divisions.update', $division->id) }}" id="UpdateSector" enctype="multipart/form-data"> 
              {{csrf_field()}}  
                @method('PUT')

               @include('divisions._formedit')

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>
            </form>
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
  $('#sectionable_type').on('change',function()
{
  var sectionable_type = $(this).val();
  if(sectionable_type){
    $.ajax({
      type:"GET",
      url:"{{url('sections/get-sectionable-list')}}?sectionable_type="+sectionable_type,
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
