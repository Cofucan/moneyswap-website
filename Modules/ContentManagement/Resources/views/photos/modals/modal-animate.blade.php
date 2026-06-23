@section('page_title', 'projects')
@extends('layouts.theme')
@push('styles')
<!-- page css-->
<link href="{{ asset ('css/modal-animate.css') }}" rel="stylesheet">
<!-- Main Stylesheet File -->
<link href="{{ asset ('css/realtycompanyUi.css') }}" rel="stylesheet">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endpush 
@section('content')

<div class="container">
	        <div class="row text-center">
	                <div class="col-12">
					    <h1 class="text-muted">Animate Modal</h1>
					</div>
					<div class="col-md-4 col-xs-12">
					    <div class="bg-faded p-2 mt-5">
    						<h2 class="animated infinite fadeIn text-muted">Fade</h2>
    						<div class="lead py-2 px-5" style="background-color:white;max-height:254px;overflow-y:auto">
    							<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-fadeUp" 	    >Down</button> 
    							<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-fadeRight"	>Left</button> 				
    							<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-fadeDown"     >Up</button> 
    							<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-fadeLeft"     >Right</button>
    							<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-fadeUpBig"	>Down</button>
    							<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-fadeRightBig"	>Left</button>
    							<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-fadeDownBig"	>Up</button> 
    							<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-fadeLeftBig" 	>Right</button>
    						</div>
    					</div>
					</div>
					<div class="col-md-4 col-xs-12">
				    	<div class="bg-faded p-2 mt-5">
    						<h2 class="animated infinite zoomIn text-muted">Zoom</h2>
    						<div class="lead py-2 px-5" style="background-color:white;max-height:254px;overflow-y:auto">
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-zoom" 	    >Center</button>
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-zoomUp" 	    >Down</button>
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-zoomRight" 	>Left</button>
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-zoomDown" 	>Up</button>
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-zoomLeft" 	>Right</button>
    						</div>
					    </div>
					</div>
					<div class="col-md-4 col-xs-12">
					    <div class="bg-faded p-2 mt-5">
    						<h2 class="animated infinite shake text-muted">Other</h2>
    						<div class="lead py-2 px-5" style="background-color:white;max-height:254px;overflow-y:auto">
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-lightSpeed"	>Light Speed</button>
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-flipX"	    >Flip Vertical</button>
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-flipY"	    >Flip Horizontal</button> 
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-roll"		    >Roll</button>
    								<button class="btn btn-secondary btn-round btn-block" data-toggle="modal" data-target=".animate" data-ui-class="a-rotate"	    >Rotate</button>
    						</div>
    					</div>
					</div>
					<div class="col-12">
					    <p class="lead p-3 mt-3">More animate visit: <a class="btn btn-link text-muted" href="https://github.com/daneden/animate.css/" target="_blank">https://github.com/daneden/animate.css/</a></p>
					</div>
			</div>
		</div>
		<div class="modal animate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body text-center p-lg">
						<p>Are you sure to execute this action?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>

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