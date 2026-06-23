
@extends('layouts.admin')
@section('page_title', $organization->organization_name)
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')
<div class="container">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>
    
        <a href="{{ url ('organizations/manage')}}" class="s-text16">
          Organizations
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>
    
        <span class="s-text17">
          Editing {{$organization->organization_name}}
        </span>
      </div> 
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Information</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>       
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-5"><small>Use the form below to update {{$organization->organization_name}}</small></h4>
      <form action="{{ route('organizations.update', $organization->id) }}" method="POST"  id="UpdateOrganization" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('PUT')
          <input type="hidden" name="industry_id" value="{{$organization->industry_id}}">
          <div class="form-group">             
            <label class="control-label" for="organization_name">Legal Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control{{ $errors->has('organization_name') ? ' is-invalid' : '' }}" id="organization_name" value="{{$organization->organization_name }}" name="organization_name" placeholder="Legal Name">                   
            @if ($errors->has('organization_name'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('organization_name') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group has-feedback">
            <label class="control-label" for="trading_name">Trading Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="trading_name" name="trading_name" value="{{$organization->trading_name }}"  placeholder="Enter Common Name">
            @if ($errors->has('trading_name'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('trading_name') }}</strong>
              </span>
            @endif
          </div> 
          
          <div class="form-group has-feedback">
            <label class="control-label" for="slogan">Slogan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="slogan" name="slogan" value="{{$organization->slogan }}"  placeholder="Enter Common Name">
            @if ($errors->has('slogan'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('slogan') }}</strong>
              </span>
            @endif
          </div>
                         
          <div class="form-row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label class="control-label">Reg Number</label>
              <input type="text" class="form-control{{ $errors->has('reg_number') ? ' is-invalid' : '' }}" id="reg_number" name="reg_number" placeholder="Enter Registration Number" value="{{$organization->reg_number}}" >
              @if ($errors->has('reg_number'))
                  <span class="invalid-feedback glyphicon glyphicon-remove">
                  <strong>{{ $errors->first('reg_number') }}</strong>
                  </span>
                @endif
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label class="control-label">VAT Number</label>
              <input type="text" class="form-control{{ $errors->has('vat_number') ? ' is-invalid' : '' }}" id="vat_number" value="{{$organization->vat_number}}"name="vat_number" placeholder="Enter Value-Added-Tax Number"  >
              @if ($errors->has('vat_number'))
                  <span class="invalid-feedback glyphicon glyphicon-remove">
                  <strong>{{ $errors->first('vat_number') }}</strong>
                  </span>
                @endif
            </div>
          </div>

        <div class="form-row">
          <div class="col-md-6 form-group">
            <label>Fav Icon</label>
            <input id="favicon" type="file" class="form-control" name="favicon">
            @if ($errors->has('favicon'))
              <span class="invalid-feedback glyphicon glyphicon-remove">
              <strong>{{ $errors->first('favicon') }}</strong>
              </span>
            @endif
          </div>
          <div class="col-md-6 form-group">
            <label>Official Logo</label>
            <input id="official_logo" type="file" class="form-control" name="official_logo">
            @if ($errors->has('official_logo'))
              <span class="invalid-feedback glyphicon glyphicon-remove">
              <strong>{{ $errors->first('official_logo') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">              
          <label>Vision</label>
          <textarea name="vision" class="resizable_textarea form-control" placeholder="Enter About Organisation">
            {!! $organization->vision !!}
          </textarea>
          @if ($errors->has('vision'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('vision') }}</strong>
            </span>
          @endif   
        </div>

        <div class="form-group">              
            <label>Mission</label>
            <textarea name="mission" class="resizable_textarea form-control" placeholder="Enter About Organisation">
              {!! $organization->mission !!}
            </textarea>
            @if ($errors->has('mission'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('mission') }}</strong>
              </span>
            @endif   
          </div>

        <hr>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              
              
              <button type="submit" class="btn btn-success">Save and close</button>
              <button class="btn btn-primary" type="reset">Cancel</button>
            
            </div>
          </div>

      </form>
    </div>  
  </div>             
</div>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection
@push('scripts')
  <script>
    CKEDITOR.replace("mission",
        {
            height: 120,
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
<!-- Select2 -->
<script>
    CKEDITOR.replace("vision",
        {
            height: 120,
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


@endpush