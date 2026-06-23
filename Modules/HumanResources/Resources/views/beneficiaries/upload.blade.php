@extends('layouts.admin')
@section('page_title', 'Upload Subscription')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">


@endpush

@section('content')

<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="{{ url ('donors/manage')}}" class="s-text16">
			Subscription
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			Upload member
		</span>
	</div>
    <div class="row">
        {{-- <div class="col-md-3 offset-md-1 order-md-2 mb-4">
            <h4 class=" mb-3">
                    Download Template 
                <span class="text-muted">Instructions</span>
                <span class="badge badge-secondary badge-pill">3</span>
                
            </h4>
            <div class="page-menu">
            </div> 

        </div> --}}
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Upload Subscription </h4>
            <span>Browse to the file location and Click the upload button </span>
            <p>Only xls, xlsx and csv files are supported </p>
            <hr>
          <form method="POST" action="{{ route('donors.import') }}" id="UploadStudent" enctype="multipart/form-data">
            {{csrf_field()}}

                <div class="form-row">
                    <input type="file" name="file" class="form-control" required>              
                </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Upload </button>
                
            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')

   
    <script src="{{ asset('js/select2.full.min.js')}}"></script>


@endpush
