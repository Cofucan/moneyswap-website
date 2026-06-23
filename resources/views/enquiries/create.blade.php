
@extends('layouts.admin')
@section('page_title', 'Add Estate')
@push('styles')

@endpush
@section('content')
<div class="row">
  <div class="col-md-6 content_title">
     	<h3> New Levy </h3>	<small>Use the form below to create what levies or dues applicable within the community</small>
	</div>
  <div class="col-md-6">

	  <div class="page_button">
    <a href="{{ url('levies') }}"><button class="btn btn-sm btn-success">List <i class="fa fa-plus"></i></button></a>
	 	<a href="{{ url('levies/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	 	</div>
	</div>
</div> 

  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Information</span>
              <span class="badge badge-secondary badge-pill">3</span>
            </h4>       
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Add Levy</h4>
      <form action="{{ url('enquiries') }}" method="POST"  id="CreateEnquiry">
          {{csrf_field()}}

           @include('enquiries._form')

          <hr class="mb-4">
            <button class="btn btn-success" type="submit">Save </button>
            <button class="btn btn-primary" type="reset">Cancel</button>

      </form>
    </div>  
  </div>             
</div>


<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\LevyRequest', '#CreateLevy'); !!}   
@endsection
@push('scripts')
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript"> 
 $(document).ready(function()
 {
   $('#leviable_type').select2();
   $('#leviable').select2();
   $('#payment_frequency').select2();
  }
  );
  $('#leviable_type').on('change',function()
{
  var leviable_type = $(this).val(); 
  if(leviable_type){
    $.ajax({
      type:"GET",
      url:"{{url('levies/get-leviable-list')}}?leviable_type="+leviable_type,
      beforeSend: function()
      {
        $('#live_loading').css("visibility", "visible");
      },
      success:function(res){ 
        if(res){ 
          
          $("#leviable").empty();
          
          $('#live_loading').css("visibility", "hidden");
          
          $.each(res,function(key,value)
          {
            $("#leviable").append('<option value="'+key+'">'+value+'</option>'); });
          }else
          {
            $("#leviable").empty(); 
          } 
        } }); 
  }else{
    $("#leviable").empty(); 
  } 
});
</script> 
@endpush