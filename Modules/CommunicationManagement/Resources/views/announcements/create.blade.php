@extends('layouts.admin')
@section('page_title', 'Create Announcement')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>

    #group_loading{
    visibility:hidden;
    }

    #live_loading{
    visibility:hidden;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">

          <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <a href="{{ url ('announcements/manage')}}" class="s-text16">
               Announcement
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Compose Announcement
            </span>
        </div>
<div class="row">
   <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Information</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        {{--  <div class="page-menu">
            <ul>
                <li><a href="{{url ('/')}}">First Term</a></li>
            </ul>
        </div>  --}}

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Compose Announcement</h4>
            <form method="POST" action="{{ route('announcements.store') }}" id="CreateAnnouncement" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}" class="form-control" />
              
                  <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="role_category_id">To</label>
                        <select name="role_category_id" class="custom-select d-block w-100 select2" id="rolecategory" required>
                            {{-- <option value=""> Select Section</option> --}}
                                @foreach($rolecategories as $key => $rolecategory)
                                    @if(old('role_category_id') == $key)
                                    <option value="{{$key}}" selected> {{$rolecategory }}</option>
                                        @else
                                    <option value="{{$key}}">  {{$rolecategory }}</option>
                                    @endif
                                @endforeach
                        </select>
                        @if ($errors->has('role_category_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('role_category_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="profiles"> Profile </label>
                        <select name="profiles[]" class="custom-select d-block w-100 select2" multiple="multiple" id="profiles" data-live-search="true">
                        </select>
                        <span id="live_loading"><i class="fa fa-spinner  fa-spin"></i></span>
                        @if ($errors->has('profiles '))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('profiles ') }}</strong>
                        </span>
                        @endif
                    </div>
                  </div>


                @include('announcements._form')

                <hr class="mb-4">
                <button type="submit" class="btn btn-success btn-sm" name="status" value="Publish"> Publish Now</button>
                <button type="submit" class="btn btn-danger btn-sm" name="status" value="Draft"> Draft</button> 
                <button class="btn btn-primary" type="reset">Cancel</button>

            </form>
        </div>
</div>
</div>
@endsection
@push('scripts')


<script type="text/javascript">

    $('#rolecategory').on('change',function()  {
    var rolecategory = $(this).val();
    if(rolecategory){
      $.ajax({
        type:"GET",
        url:"{{url('rolecategories/get-profiles')}}?rolecategory="+rolecategory,
        beforeSend: function()
        {
          $('#live_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){
            $("#profiles").empty();
            $('#live_loading').css("visibility", "hidden");
            $.each(res,function(key,value)
            {
              $("#profiles").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#profiles").empty();
            }
          } });
    }else{
      $("#profiles").empty();
    }
  });
</script>


<script type="text/javascript">

    $('#program').on('change',function()  {
    var program = $(this).val();
    if(program){
      $.ajax({
        type:"GET",
        url:"{{url('sections/get-streams')}}?program="+program,
        beforeSend: function()
        {
          $('#group_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){
            $("#stream").empty();
            $('#group_loading').css("visibility", "hidden");
            $.each(res,function(key,value)
            {
              $("#stream").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#stream").empty();
            }
          } });
    }else{
      $("#stream").empty();
    }
  });
</script>
<script>
 
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide Filter') {
                $(this).text('To Selected Stream');
            } else {
                $(this).text('Hide Filter');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });

</script>
<script>
    CKEDITOR.replace("body",
        {
            height: 180
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>



@endpush
