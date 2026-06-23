@extends('layouts.admin')
@section('page_title', 'Announcements')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
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
        <div class="col-md-9 col-sm-8 content_title">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
                Announcement
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>

        
        </div>
        <div class="col-md-3 col-sm-3 col-8">
            
        <!-- Mark Assignment Modal -->
        <div class="modal fade seminor-login-modal" tabindex="-1" role="dialog"  aria-hidden="true" id="compose">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">                      
                    <!-- Modal body -->
                    <div class="modal-body seminor-login-modal-body">
                        <h5 class="modal-title text-center">Compose Announcement</h5>
                        <button type="button" class="close" data-dismiss="modal">
                        <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                        </button>
            
                        <hr>
                        <form method="POST" action="{{ route('announcements.store') }}" id="CreateAnnouncement" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}" class="form-control" />
                            
                            
                            @include('announcements._form')
                            
                            
                            <hr>
                            <div class="btn-check-log">
                                <button type="submit" class="btn btn-primary btn-sm" name="status" value="Draft">Save as Draft</button>
                                <button type="submit" class="btn btn-danger btn-sm" name="status" value="Scheduled">Send</button>
                            </div>
                        
                        </form>
            
                    </div>
                </div>
            </div>
            </div>  
        </div>
    </div>    

    <div class="row">
        <div class="col-md-2 col-sm-3 side-menu">
            <a href="#" class="btn btn-sm btn-success btn-block mt-2" data-toggle="modal" data-target="#compose">Compose <i class="fa fa-plus"></i></a>
            @include('announcements._menu')
        </div>
        <div class="col-md-8 col-sm-9 content_title">
            <h4> Announcement </h4>	
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @foreach(Auth::user()->notifications as $notification)
                        <div class="announcement mb-3">
                            <div class="col-md-12">
                                <a href="{{ route('announcements.show', $announcement->id) }}">        
                                    <div class="row title">
                                        <div class="col-md-8 col-sm-8 col-8"><h6 class="">{{ $announcement->headline }}</h6></div>
                                        <div class="col-md-4 col-sm-4 col-4 text-right "><span class="s-text4"><i class="fa fa-clock-o"></i>: {{ $announcement->publish_date }} </span></div>
                                    </div>
                                    <div class="announcement_body">
                                    {!! str_limit($announcement->announcement_body, $limit = 70, $end = '...')!!}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


 

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
    CKEDITOR.replace("announcement_body",
        {
            height: 180
        });
</script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

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
 @endpush
