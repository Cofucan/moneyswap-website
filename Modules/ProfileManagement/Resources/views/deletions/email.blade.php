@section('page_title', 'Home')
@extends('layouts.sign-in')
@push('style')
<!-- Main Stylesheet File -->
<link href="{{ asset ('css/email.css') }}" rel="stylesheet">
@endpush
@section('content')

   
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="alert col-md-8 offset-md-2 text-center">
                <h4> <i class="fa fa-check-circle"></i> Your request has been submitted Successfully</h4>
            </div>

            <div class="col-md-8 offset-md-2">
                <p>Kindy review this </p>
                <div class="row mt-4">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Contact Name:</strong>
                            Balogun Abiodun
                            {{-- {{ $brief->contact_name }} --}}
                        </div>
                        
                        <div class="form-group">
                        <strong>Telephone  :</strong>
                        08119470964
                        {{-- {{ $brief->telephone }} --}}
                        </div>
                    </div>
            
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Status  :</strong>
                        Received
                        {{-- {{ $brief->status }} --}}
                        </div>
                        
                        <div class="form-group">
                            <strong>Email  :</strong>
                            abiodun@systempace.com
                            {{-- {{ $brief->email }} --}}
                        </div>
                    </div>
            
                    <div class="col-md-12">
                        <hr>
                    </div>
            
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Property Type:</strong>
                            Land
                            {{-- {{ $brief->realtyunit_type }} --}}
                        </div>
                        
                        <div class="form-group">
                        <strong>Location  :</strong>
                        Ibeju-Lekki
                        {{-- {{ $brief->Neighbourhood->neighbourd_name }} --}}
                        </div>
                    </div>
            
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Contract Type  :</strong>
                        For Sale
                        {{-- {{ $brief->contract_type }} --}}
                        </div>
                        
                        <div class="form-group">
                            <strong>Budget  :</strong>
                            NGN 100,000
                            {{-- {{ $brief->currency }} {{number_format($brief->budget,2) }} --}}
                        </div>
                    </div>
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <hr>
                    
                         <h5 class="mb-2">  <strong>Request for Land </strong> </h5>	
                        {{-- <h5 class="mb-2">  <strong>{{ $brief->brief_subject }}</strong> </h5>	 --}}
                        <div class="form-group">
                            <span>We are a real estate company committed to making more landlords through easy property acquisition schemes</span>
                            {{-- <strong>Message :</strong><br> --}}
                            {{-- {!! $brief->enquiry_body !!} --}}
                        </div>
                    </div>       
            
                    
                </div>
            </div>
        </div>
    </div>
</section>   

  
@endsection
@push('scripts')
<script>
    $(function(){
	$('[role=dialog]')
	    .on('show.bs.modal', function(e) {
		    $(this)
		        .find('[role=document]')
		            .removeClass()
		            .addClass('modal-dialog ' + $(e.relatedTarget).data('ui-class'))
	})
})
</script>

@endpush
