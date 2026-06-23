@extends('layouts.admin')
@section('page_title', $portal->portal_name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
@endpush
@section('content')
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text16">
			Portal
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</span>

		<span class="s-text17">
			Edit [{{$portal->portal_name }}]
		</span> 
	</div> 
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit portal </h4>
            <form action="{{ route('portals.update', $portal->id) }}" method="POST"  id="UpdatePortal" enctype="multipart/form-data">
                {{csrf_field()}}  
                @method('PUT')
                <div class="form-group">
                    <label for="portal_name"> Name</label>
                    <input type="text" name="portal_name" value="{{$portal->portal_name }}" class="form-control" id="portal_name" />
                    @if ($errors->has('portal_name'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('portal_name') }}</strong>
                        </span>
                    @endif     
                </div> 

                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="portal_email">Portal Email</label>
                        <input type="email" value="{{$portal->portal_email }}" class="form-control {{ $errors->has('portal_email') ? ' is-invalid' : '' }}" id="email" name="portal_email">
                        
                        
                        @if ($errors->has('portal_email'))
                            <span class="invalid-feedback glyphicon glyphicon-remove form-control">
                            <strong>{{ $errors->first('portal_email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="control-label" for="portal_phonenumber">Portal Phone Number</label>
                        <input type="tel" value="{{$portal->portal_phonenumber }}" class="form-control {{ $errors->has('portal_phonenumber') ? ' is-invalid' : '' }}" id="portal_phonenumber" name="portal_phonenumber">
                                                
                        @if ($errors->has('portal_phonenumber'))
                            <span class="invalid-feedback glyphicon glyphicon-remove form-control">
                            <strong>{{ $errors->first('portal_phonenumber') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class=" form-group">
                    <label class="control-label" for="custom_url">Custom URL</label>
                    <input type="text" value="{{$portal->custom_url}}" class="form-control {{ $errors->has('custom_url') ? ' is-invalid' : '' }}" id="email" name="custom_url">
                    
                    
                    @if ($errors->has('custom_url'))
                        <span class="invalid-feedback glyphicon glyphicon-remove form-control">
                        <strong>{{ $errors->first('custom_url') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group ">
                    <label for="slogan">Slogan</label>
                    <textarea name="slogan" class="form-control" rows="1">{!! $portal->slogan !!}</textarea>
                    @if ($errors->has('slogan'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('slogan') }}</strong>
                        </span>
                    @endif
                </div> 

                

                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="date_started">Date Started</label>
                        <input type="date" value="{{$portal->date_started}}" class="form-control {{ $errors->has('date_started') ? ' is-invalid' : '' }}" id="email" name="date_started">
                        
                        
                        @if ($errors->has('date_started'))
                            <span class="invalid-feedback glyphicon glyphicon-remove form-control">
                            <strong>{{ $errors->first('date_started') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="control-label" for="default_currency">Default Currency</label>
                        <input type="text" value="{{$portal->default_currency}}" class="form-control {{ $errors->has('default_currency') ? ' is-invalid' : '' }}" id="default_currency" name="default_currency">
                                                
                        @if ($errors->has('default_currency'))
                            <span class="invalid-feedback glyphicon glyphicon-remove form-control">
                            <strong>{{ $errors->first('default_currency') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>  

                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="portal_logo">Portal Logo</label>
                        <input type="file" name="portal_logo" value="{{$portal->Organization->official_logo}}" class="form-control" placeholder="Upload Page Imaga"  id="portal_logo" />
                        @if ($errors->has('portal_logo'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('portal_logo') }}</strong>
                            </span>
                        @endif
                    </div>  
                </div>              

                
                  
                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>
                
            </form>
                
        </div>
        <div class="col-md-3 offset-md-1">
            <div class="box box-collapsed">
                <div class="box-header text-center">
                    <h5>Publish</h5>
                </div>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-clock-o"></i>
                                Date Published: <b>{{ $portal->date_published }}</b></p>
                        </div>

                        <div class="col-md-12 publish-form">
                                <p><i class="fa fa-clock-o"></i>
                                    Portal Slogan: <b>{{ $portal->slogan }}</b></p>
                            </div>                       

                        <div class="col-md-12 p-t-20">

                            <img src="{{ asset ($portal->Organization->official_logo) }}" alt="{{$portal->portal_name }}" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>


@endsection
@push('scripts')
<script>
    CKEDITOR.replace("portal_description",
        {
            height: 120
        });
</script>

@endpush
