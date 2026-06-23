@extends('layouts.admin')
@section('page_title', 'Add Designation')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
    
  #role_loading{
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

            <a href="{{ url ('designations')}}" class="s-text16">
                Designation
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Add Designation
            </span>
        </div>
    <div class="row">
    <div class="col-md-3 offset-md-1 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Instructions</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <div class="designation-menu">
            
            </div>


            </div>
            <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Add New Designation</h4>
            <form method="POST" action="{{ route('designations.store') }}" id="CreateDesignation" enctype="multipart/form-data">

                    {{csrf_field()}}
                    @include('designations._form')

                    <hr class="mb-4">
                    <button class="btn btn-success" type="submit">Save </button>
                    <button class="btn btn-primary" type="reset">Cancel</button>

                </form>
            </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
     CKEDITOR.replace("job_description",
        {
            height: 100,
            // Define the toolbar streams as it is a more accessible solution.
         toolbarGroups: [{
          "name": "basicstyles",
          "streams": ["basicstyles"]
        },
        {
          "name": "links",
          "streams": ["links"]
        },
        {
          "name": "paragraph",
          "streams": ["list", "blocks"]
        },
        {
          "name": "document",
          "streams": ["mode"]
        },
        {
          "name": "insert",
          "streams": ["insert"]
        },
        {
          "name": "styles",
          "streams": ["styles"]
        },
        {
          "name": "about",
          "streams": ["about"]
        }
      ],
      // Remove the redundant buttons from toolbar streams defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });

    CKEDITOR.replace("responsibilities",
        {
            height: 100,
            // Define the toolbar streams as it is a more accessible solution.
        toolbarGroups: [{
        "name": "basicstyles",
        "streams": ["basicstyles"]
        },
        {
        "name": "links",
        "streams": ["links"]
        },
        {
        "name": "paragraph",
        "streams": ["list", "blocks"]
        },
        {
        "name": "document",
        "streams": ["mode"]
        },
        {
        "name": "insert",
        "streams": ["insert"]
        },
        {
        "name": "styles",
        "streams": ["styles"]
        },
        {
        "name": "about",
        "streams": ["about"]
        }
    ],
    // Remove the redundant buttons from toolbar streams defined above.
    removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function()
 {
   $('.select2').select2();
});
</script>

 <script type="text/javascript">
  $('#department').on('change',function(){
  var department = $(this).val();
  if(department){
    $.ajax({
      type:"GET",
      url:"{{url('departments/get-roles')}}?department="+department,
      beforeSend: function()
      {
        $('#role_loading').css("visibility", "visible");
      },
      success:function(res){
        if(res){

          $("#role").empty();
          $('#role_loading').css("visibility", "hidden");
          $.each(res,function(key,value)
          {
            $("#role").append('<option value="'+key+'">'+value+'</option>'); });
          }else
          {
            $("#role").empty();
          }
        } });
  }else{
    $("#role").empty();
  }
});
</script>
@endpush
