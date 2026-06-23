@extends('layouts.admin')
@section('page_title', 'Corporate Info')
@push('styles')
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/newtab.css') }}">
<style>
    #state_loading{
    visibility:hidden;
    }
    #city_loading{
    visibility:hidden;
    }
    #neighbourhood_loading{
    visibility:hidden;
    }
</style>
@endpush
@section('content')
<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Corporate Info</li>

    </ol>
</nav>
    <div class="row">
        <div class="col-md-12">
            <h5 class="line">Corporate Info</h5>

            <div id="tabs" class="mt-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#about-organization" role="tab" aria-controls="about-organization">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#contacts-tab" role="tab" aria-controls="contacts-tab">Contacts & Branches</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#corevalue-tab" role="tab" aria-controls="corevalue-tab">Core Values</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#outlets-tab" role="tab" aria-controls="outlets-tab">Social Handles</a>
                    </li>

                   

                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="about-organization" role="tabpanel">
                        <div class="row p-t-4">
                            <div class="col-md-12 section-head">
                                    <div class="pull-left client-info ml-3">
                                    <span class="strong ">Corporate Info </span>
                                    </div>

                            </div>
                            <div class="col-md-12 mt-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="2">
                                             <strong>Name: </strong> {{$portal->Organization->legal_name }} ( {{$portal->Organization->trading_name }})
                                        </td>
                                    </tr>

                                    <tr>

                                        <td colspan="2"><strong>Slogan: </strong> {{$portal->Organization->slogan }}
                                            <a data-toggle="modal" class="pull-right" data-target="#slogan1" href="#slogan1">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Official Logo: </strong> <img src="{{asset($portal->Organization->official_logo)}}" alt="Portal Logo" height="70px"></td>
                                        <td><strong>Favicon: </strong>
                                            <a data-toggle="modal" class="pull-right" data-target="#logo1" href="#logo1">
                                            <i class="fa fa-edit"></i>
                                            </a> <br>
                                            <img src="{{asset($portal->Organization->favicon)}}" alt="Portal Logo" height="70px"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">  <strong>Vision: </strong>
                                            <a data-toggle="modal" class="pull-right" data-target="#vision" href="#vision">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!!$portal->Organization->vision !!}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">  <strong>Mission: </strong>
                                            {!!$portal->Organization->mission !!}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="contacts-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-9">
                                <strong>Contacts</strong>
                            </div>
                            <div class="col-md-3 section-head bg-light">
                                    <a data-toggle="modal" class="btn btn-sm btn-success" data-target="#portal" href="#portal">
                                        <i class="fa fa-edit"></i>  Edit
                                    </a>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="50%"><strong>Email: </strong> {{$portal->email }}

                                            </td>
                                        <td width="50%"><strong>Tel:</strong>  {{$portal->telephone }}

                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="section-head mt-4">
                                    <div class="row no-gutters">
                                        <div class="col-md-9 col-sm-8 col-6">
                                            <strong>Branches</strong>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-6">
                                            <a data-toggle="modal" class="btn-sm btn btn-success btn-block" data-target="#new-outlet" href="#new-outlet">
                                                <i class="fa fa-plus"></i> New Branch
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 p-3 rounded border bg-light">
                                    <div class="row no-gutters">
                                        <div class="col-md-4 col-sm-6 mb-2">
                                            <small class="text-muted d-block">Total Branches</small>
                                            <span class="h5 mb-0">{{ $outlets->count() }}</span>
                                        </div>
                                        <div class="col-md-4 col-sm-6 mb-2">
                                            <small class="text-muted d-block">Headquarters</small>
                                            <span class="h5 mb-0">{{ $outlets->where('outlet_type', 'HeadQuarter')->count() }}</span>
                                        </div>
                                        <div class="col-md-4 col-sm-6 mb-2">
                                            <small class="text-muted d-block">Branch Offices</small>
                                            <span class="h5 mb-0">{{ $outlets->where('outlet_type', 'Branch')->count() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Outlet</th>
                                                <th>Type</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($outlets as $outlet)
                                                <tr>
                                                    <td>{{ $outlet->id }}</td>
                                                    <td>{{ $outlet->label }}</td>
                                                    <td>
                                                        @if($outlet->outlet_type === 'HeadQuarter')
                                                            <span class="badge badge-primary">HeadQuarter</span>
                                                        @else
                                                            <span class="badge badge-info">{{ $outlet->outlet_type }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $outlet->address_prefix }} {{ $outlet->building_number }}, {{ $outlet->street_name }}</td>
                                                    <td>{{ !empty($outlet->City->city_name) ? $outlet->City->city_name : '-' }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('outlets.show', $outlet->id) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('outlets.edit', $outlet->id) }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">No branches have been added yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="corevalue-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-head">
                                    <div class="row no-gutters">
                                        <div class="col-md-9 col-sm-8 col-6">
                                            <span class="strong ">Core Values</span>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-6">
                                            <a data-toggle="modal" class="btn-sm btn btn-success btn-block" data-target="#new-value" href="#new-value">
                                                <i class="fa fa-plus"></i> Add Value
                                            </a>
                                            @include('organizationmanagement::corevalues._form')
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Image</th>
                                                        <th>Value</th>
                                                        <th>Status</th>
                                                        <th width="20%">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($portal->Organization->corevalues as $value)
                                                        @include('organizationmanagement::corevalues._data')
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="outlets-tab" role="tabpanel">
                        <div class="row mt-4">
                            <div class="col-md-9">
                                <strong>Social Handles</strong>
                            </div>
                            <div class="col-md-3 section-head bg-light">
                                    <a data-toggle="modal" class="btn btn-sm btn-success" data-target="#social-handle" href="#social-handle">
                                        Add New
                                    </a>
                            </div>
                            <div class="col-md-9 mt-4">
                                    @include('socialmanagement::socialhandles._table')
                            </div>
                        </div>
                    </div>

                    {{-- <div class="tab-pane" id="bankaccounts-tab" role="tabpanel">
                        <div class="row mt-4">
                            <div class="col-md-9">
                                <strong>Bank Accounts</strong>
                            </div>
                            <div class="col-md-3 section-head bg-light">
                                <a data-toggle="modal" class="btn btn-sm btn-success" data-target="#newbankaccount" href="#newbankaccount">
                                    Add New
                                </a>
                                @include('bankaccounts._form')
                            </div>
                            <div class="col-md-12 mt-4">
                                    @include('bankaccounts._table')
                            </div>
                        </div>
                    </div>  --}}

                    {{-- <div class="tab-pane" id="paymentterms-tab" role="tabpanel">
                        <div class="row mt-4">
                            <div class="col-md-9">
                                <strong>Payment Terms</strong>
                            </div>
                            <div class="col-md-3 section-head bg-light">
                                <a data-toggle="modal" class="btn btn-sm btn-success" data-target="#newterms" href="#newterms">
                                    Add New
                                </a>
                                @include('paymentterms._form')
                            </div>
                            <div class="col-md-12 mt-4">
                                    @include('paymentterms._table')
                            </div>
                        </div>
                    </div>  --}}

                </div>

           </div>

           @include('socialmanagement::socialhandles._modalform')



                    {{-- address modal begins--}}
                    <div class="modal fade" id="new-outlet" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <div>
                                        <h4 class="modal-title text-center mb-0">Add New Branch</h4>
                                        <small class="text-muted">Create a new outlet for {{ $portal->Organization->legal_name }}</small>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('outlets.store') }}" id="CreateOutlet">
                                        {{csrf_field()}}

                                        @include('organizationmanagement::outlets._form')

                                        <div class="modal-footer px-0 pb-0">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success" type="submit">Save </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                {{-- modal ends--}}

                    {{-- organization modal begins--}}
                        <div class="modal fade" id="organization" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-center">Edit</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('organizations.update', $portal->organization_id) }}" id="UpdatePerson">
                                            {{csrf_field()}}
                                            @method('PUT')

                                            @include('organizationmanagement::organizations._portaledit')

                                            <div class="modal-footer">
                                                <button class="btn btn-success" type="submit">Save </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- modal ends--}}

                    {{-- slogan modal begins--}}
                    <div class="modal fade" id="slogan1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{-- <h4 class="modal-title text-center">Edit</h4> --}}
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('organizations.update', $portal->organization_id) }}" id="UpdatePerson">
                                        {{csrf_field()}}
                                        @method('PUT')


                                        <div class="form-group">
                                            <label>Slogan</label>
                                            <input type="text" class="form-control{{ $errors->has('slogan') ? ' is-invalid' : '' }}" id="slogan" name="slogan" value="{{$portal->Organization->slogan}}" >
                                            @if ($errors->has('slogan'))
                                              <span class="invalid-feedback glyphicon glyphicon-remove">
                                              <strong>{{ $errors->first('slogan') }}</strong>
                                              </span>
                                            @endif
                                          </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Save </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                {{-- modal ends--}}

                 {{-- logo modal begins--}}
                 <div class="modal fade" id="logo1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- <h4 class="modal-title text-center">Edit</h4> --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('organizations.update', $portal->organization_id) }}" id="UpdatePerson">
                                    {{csrf_field()}}
                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="col-md-12 form-group">
                                          <label>Official Logo</label>
                                          <input id="official_logo" type="file" class="form-control" name="official_logo">
                                          @if ($errors->has('official_logo'))
                                            <span class="invalid-feedback glyphicon glyphicon-remove">
                                            <strong>{{ $errors->first('official_logo') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                        <div class="col-md-12 form-group">
                                          <label>Fav Icon</label>
                                          <input id="favicon" type="file" class="form-control" name="favicon">
                                          @if ($errors->has('favicon'))
                                            <span class="invalid-feedback glyphicon glyphicon-remove">
                                            <strong>{{ $errors->first('favicon') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                      </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success" type="submit">Save </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            {{-- modal ends--}}

                      {{-- vision modal begins--}}
                      <div class="modal fade" id="vision" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-center"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('organizations.update', $portal->organization_id) }}" id="UpdatePerson">
                                        {{csrf_field()}}
                                        @method('PUT')

                                            <div class="form-group">
                                                <label for="vision">Vision Statement</label>
                                                <textarea name="vision" class="form-control {{ $errors->has('vision') ? ' is-invalid' : '' }}" rows="5" id="textarea1">{!!$portal->Organization->vision!!} </textarea>
                                                @if ($errors->has('vision'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('vision') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="mission">Mission Statement </label>
                                                <textarea name="mission" class="form-control {{ $errors->has('mission') ? ' is-invalid' : '' }}" rows="5" id="textarea2"> {!!$portal->Organization->mission!!} </textarea>
                                                @if ($errors->has('mission'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('mission') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Save </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                {{-- modal ends--}}

                       {{-- portal modal begins--}}
                       <div class="modal fade" id="portal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-center">Edit</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('portals.update', $portal->id) }}" id="UpdatePerson">
                                        {{csrf_field()}}
                                        @method('PUT')

                                        @include('portals._formedit')

                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Save </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                {{-- modal ends--}}


            {{-- <h5 class="line">Portal</h5>
            <button type="button" class="btn btn-primary btn-sm mb-3 pull-right" data-toggle="modal" data-target="#profile-info">
                <i class="fa fa-edit"></i> Edit
            </button>
             --}}

        </div>
    </div>


@endsection
@push('scripts')
<script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#textarea1').summernote({
    tabsize: 2,
    height: 200,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', [ 'codeview', 'help']]
    ]
  });
  $('#textarea2').summernote({
    tabsize: 2,
    height: 200,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', [ 'codeview', 'help']]
    ]
  });
</script>
<script>
  @php
    $hasOutletErrors = $errors->has('label')
      || $errors->has('outlet_label')
      || $errors->has('outlet_type')
      || $errors->has('country_code')
      || $errors->has('state_id')
      || $errors->has('state_name')
      || $errors->has('city_id')
      || $errors->has('city_name')
      || $errors->has('street_name')
      || $errors->has('building_no')
      || $errors->has('building_number')
      || $errors->has('telephone');
  @endphp
  @if($hasOutletErrors)
      $('a[href="#contacts-tab"]').tab('show');
      $('#new-outlet').modal('show');
  @elseif(session('success') && stripos(session('success'), 'outlet') !== false)
      $('a[href="#contacts-tab"]').tab('show');
  @endif
</script>
 <script>

  jQuery(document).ready(function($){
      $(".toggle_container").hide();
      $("button.reveal").click(function(){
          $(this).toggleClass("active").next().slideToggle("fast");

          if ($.trim($(this).text()) === 'Hide') {
              $(this).text('Add More');
          } else {
              $(this).text('Hide');
          }

          return false;
      });
      $("a[href='" + window.location.hash + "']").parent(".reveal").click();

  });

</script>




@endpush
