@extends('layouts.admin')
@section('page_title', 'Add Program')
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

            <a href="{{ url ('programs/manage')}}" class="s-text16">
                Programs
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                New Program
            </span>
        </div>
<div class="row">
  <!-- <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Existing Programs</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">
            <ul>
                <li><a href="{{url ('/')}}">First Term</a></li>
            </ul>
        </div> -->

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3"> New Program</h4>
            <form method="POST" action="{{ route('programs.store') }}" id="CreateSection" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="sectionable_type"> Where to add Section</label>
                        <select name="sectionable_type" class="custom-select d-block w-100 select2 {{ $errors->has('sectionable_type') ? ' is-invalid' : '' }}" id="sectionable_type" >
                            <option>Choose one </option>
                            <option  value="event">Event</option>
                            <option  value="page">Page</option>
                            <option  value="school">School</option>
                            <option  value="activity">Activity</option>
                        </select>
                        @if ($errors->has('sectionable_type'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('sectionable_type') }}</strong>
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

                @include('catalogmanagement::programs._form')

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>

            </form>
        </div>
</div>

@endsection
@push('scripts')
<script>
    CKEDITOR.replace("section_overview",
        {
            height: 120
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($)
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
        url:"{{url('programs/get-sectionable-list')}}?sectionable_type="+sectionable_type,
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
