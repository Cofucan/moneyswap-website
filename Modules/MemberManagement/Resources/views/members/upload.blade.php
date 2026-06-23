@extends('layouts.admin')
@section('page_title', 'Upload Members')
@push('styles')

<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">

@endpush

@section('content')

<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="{{ url ('members/manage')}}" class="s-text16">
			Members
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			Upload members
		</span>
	</div>
    <div class="row">

        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Upload Members List </h4>
            <span><b>Follow the procedures to upload new members </b></span>
            <ul>
              <li> Download the bulk upload template file by clicking the 'Download Template' button. </li>
              <li> Fill the  details on each row without modifying the column headers or file extension. </li>
              <li> Browse to the location of the populated template file to attach it to the form </li>
              <li> Click the submit button to complete the file upload</li>
            </ul>
            <a href="{{ asset('files/bulkmember.csv') }}" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> Download Template</a>
            <hr>
            <div class="form-card">
                <form method="POST" action="{{ route('members.import') }}" id="UploadNeighbourhoods" enctype="multipart/form-data">
                    {{csrf_field()}}



                    <div class="form-group">
                        <input type="file" name="file" class="form-control" required>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-success" type="submit">Upload </button>

                </form>
            </div>
        </div>
</div>
</div>


@endsection
@push('scripts')
    <script src="{{ asset('js/select2.full.min.js')}}"></script>

  <script type="text/javascript">
    $('#level').on('change',function(){
      var level = $(this).val();
      if(level){
        $.ajax({
          type:"GET",
          url:"{{url('levels/get-streams')}}?level="+level,
          beforeSend: function()
          {
            $('#live_loading').css("visibility", "visible");
          },
          success:function(res){
            if(res){

              $("#stream").empty();
              $('#live_loading').css("visibility", "hidden");
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
