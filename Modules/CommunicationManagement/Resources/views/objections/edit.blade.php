@extends('layouts.admin')
@section('page_title', 'Add Fee')
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

        <a href="{{ url ('posts/addresses')}}" class="s-text16">
            Fees
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
           Edit Fee
        </span>
    </div>
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <!-- <div class="page-menu">
            <ul>
                <li><a href="{{url ('/')}}">Literary & Debate Group</a></li>
                <li><a href="{{url ('/')}}">Boys Scout/Girls Guild</a></li>
                <li><a href="{{url ('/')}}">Press Club</a></li>
            </ul>
        </div> -->

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Fee </h4>
          <form method="POST" action="{{ route('fees.store') }}" id="CreateEvent" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                  <label for="fee_type_id"> Fee Type</label>
                  <select id="fee_type_id" class="custom-select select2 w-100 form-control" data-live-search="true" >
                            <option> </option>

                        </select>
                  @if ($errors->has('fee_type_id'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('fee_type_id') }}</strong>
                      </span>
                  @endif
                </div>

                <!-- <div class="form-group">
                    <label for="item_name"> Item Name</label>
                    <input type="text" name="item_name" value="{{ old('item_name')}}" class="form-control" placeholder="Enter Event Title"  id="item_name" />
                    @if ($errors->has('item_name'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('item_name') }}</strong>
                        </span>
                    @endif
                </div> -->

                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="grade_id"> Level</label>
                        <select name="grade_id" class="custom-select select2 w-100" id="grade_id" required>
                            <option>Choose one </option>

                        </select>
                        @if ($errors->has('grade_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('grade_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="term"> Term</label>
                        <select name="term" class="custom-select select2 d-block w-100" id="term" multiple="multiple" data-live-search="true" required>
                            <option>Choose one </option>
                            <option  value="school">First Term</option>
                            <option  value="page">Second Term</option>
                            <option  value="event">Third Term</option>
                        </select>
                        @if ($errors->has('term'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('term') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label class="control-label" for="amount">Amount &nbsp;<span class="requiredfield">*</span></label>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <select id="currency" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a currency ...">
                              <option>NGN</option>
                              <option>USD</option>
                          </select>
                      </div>
                      <input type="text" class="form-control" value="{{$fee->amount}}" id="amount" name="amount" placeholder="" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 has-feedback">
                        <label class="control-label" for="discount_value"> Maximum Discount </label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" value="{{$fee->amount}}" id="discount_value" name="discount_value" placeholder="" required>
                            <div class="input-group-append">
                                <select id="discount_value" class="custom-select select2 w-100 form-control" data-live-search="true" >
                                    <option>Select Rate</option>
                                    <option>Flat Rate</option>
                                    <option>Percentage</option>
                                </select>
                            </div>
                            @if ($errors->has('term'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('term') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="pricing_metric"> Pricing Metric</label>
                        <input type="text" name="pricing_metric" value="{{ $fee->pricing_metric}}" class="form-control" id="pricing_metric" />
                        @if ($errors->has('pricing_metric'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('pricing_metric') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-5">
                        <div class="custom-control custom-radio">
                            <input id="mandatory_status" name="enrolment_type" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="mandatory_status">Mandatory</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="custom-control custom-radio">
                            <input id="optional" name="enrolment_type" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="optional">Optional</label>
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group ">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter description">
                    {{ old('description')}}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>               -->


                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function(){
      $('.select2').select2();
    });
</script>
<script>
     CKEDITOR.replace("description",
        {
            height: 100,
            // Define the toolbar groups as it is a more accessible solution.
         toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
          "name": "about",
          "groups": ["about"]
        }
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });
</script>

@endpush
