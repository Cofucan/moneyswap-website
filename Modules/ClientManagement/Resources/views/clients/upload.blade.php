@extends('layouts.admin')
@section('page_title', 'Upload Client')
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

		<a href="{{ url ('clients')}}" class="s-text16">
			Client
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			Upload client
		</span>
	</div>
    <div class="row">
        {{-- <div class="col-md-3 offset-md-1 order-md-2 mb-4">
            <h4 class=" mb-3">
                    Download Data Template
                <span class="text-muted">Instructions</span>
                <span class="badge badge-secondary badge-pill">3</span>

            </h4>
            <div class="page-menu">
            </div>

        </div> --}}

        <div class="col-md-9 order-md-1">
          <h4 class="mb-3">Upload Clients </h4>
          <span><b>Follow the procedures to upload new clients </b></span>
          <ul>
            <li> Download the bulk upload template file by clicking the 'Download Data Template' button. </li>
            <li> Fill the  details on each row without modifying the column headers or file extension. </li>
            <li> Browse to the location of the populated template file to attach it to the form </li>
            <li> Click the 'Upload' button to complete the file upload</li>
          </ul>
          <a href="{{ asset('files/clients.csv') }}" class="btn btn-primary btn-sm" download> <i class="fa fa-download"></i> Download Template</a>
          <hr>
          <div class="form-card">
            <form method="POST" action="{{ route('clients.import') }}" id="UploadStudent" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="academic_term_id" value="{{$currentterm->id}}">
                <input type="hidden" name="enrolment_action" value="Re-enrolment">
                    <div class="form-row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="outlet">Outlet</label>
                                <select name="outlet_id" class="custom-select select2" id="outlet" required>
                                    <option value="">Select Clients Outlet </option>
                                    @foreach($outlets as $key => $outlet)
                                    <option value="{{$key}}"> {{$outlet}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('outlet_id'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('outlet_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="batch_id">Class</label>
                                <select name="batch_id" class="custom-select d-block w-100 select2" id="batch" required>
                                @foreach($batches as $key => $batch)
                                <option value="{{$key}}"> {{$batch}}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('batch_id'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('batch_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="file" name="file" class="form-control" required>
                    </div>

                  <hr class="mb-4">
                  <button class="btn btn-success" type="submit">Upload File</button>

              </form>
          </div>

        </div>
</div>
</div>


@endsection
@push('scripts')
    <script src="{{ asset('js/select2.full.min.js')}}"></script>

@endpush
