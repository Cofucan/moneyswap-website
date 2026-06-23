@push('styles')
    <style>
    .myDiv{
        display:none;
    }

    </style>
@endpush


<div class="modal fade" id="addfee{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Add Payment Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('fees.store') }}" id="CreateFee" >
                    {{csrf_field()}}
                    <div class="form-group mb-2">
                        <label for="item_id"> <strong> Item Name:</strong> {{  $item->label }}</label>
                        <input type="hidden" name="item_id" value="{{ $item->id }}" id="item_id" />
                    </div>
                    <div class="form-group">

                        <div class="custom-control custom-radio custom-control-inline">
                          <input id="general{{ $item->id }}" name="feeable_type" type="radio" value="" class="custom-control-input" required>
                          <label class="custom-control-label" for="general{{ $item->id }}">General Fee</label>
                        </div>
                        @if ($item->label == 'Transport')
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="Transport{{ $item->id }}" name="feeable_type" type="radio" value="fare" class="custom-control-input" required>
                            <label class="custom-control-label" for="Transport{{ $item->id }}">Transport</label>
                            <input type="hidden" name="city_id" value="1" id="item_id" />
                        </div>
                        @else
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="rate{{ $item->id }}" name="feeable_type" type="radio" value="program" class="custom-control-input" required>
                            <label class="custom-control-label" for="rate{{ $item->id }}">Apply to Program</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="Level{{ $item->id }}" name="feeable_type" type="radio" value="level" class="custom-control-input" required>
                            <label class="custom-control-label" for="Level{{ $item->id }}">Apply to Class </label>

                        </div>
                        @endif
                        @if ($errors->has('feeable_type'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('feeable_type') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if ($item->label == 'Transport')
                        <div id="showfare" class="myDiv">
                            <div class="form-group">
                                <label for="neighbourhood_id"> Neighbourhood </label>
                                <input type="text" name="neighbourhood_name" value="{{ old ('neighbourhood_name') }}" class="form-control {{ $errors->has('neighbourhood_name') ? ' is-invalid' : '' }}" placeholder="Enter Neighbourhood Name"  id="neighbourhood_name" />
                                @if ($errors->has('neighbourhood_id'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('neighbourhood_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @else
                    <div id="showgrade" class="myDiv">
                        <div class="form-group">
                            <label for="grade_id"> Class/Level </label>
                            <select name="grade_id" class="custom-select d-block w-100 select2" id="grade_id">
                                <option value=""> Choose Class</option>
                                @foreach($levels as $key => $level)
                                    <option value="{{$key}}"> {{$level}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('grade_id'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('grade_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                        <div id="showprogram" class="myDiv">
                            <div class="form-group">
                                <label for="program_id"> Program </label>
                                <select name="program_id" class="custom-select d-block w-100 select2" id="program_id">
                                    <option value=""> Choose Program</option>
                                    @foreach($programs as $key => $program)
                                        <option value="{{$key}}"> {{$program}}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('program_id'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('program_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="mb-3 form-group">
                            <label for="label"> Name <span class="required"> (If empty, payment item name will be used)</span> </label>
                            <input type="text" name="label" value="{{old('label')}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="display name"  id="label" />
                            @if ($errors->has('label'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('label') }}</strong>
                                </span>
                            @endif
                        </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="rate">Price &nbsp;<span class="requiredfield">*</span></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                       <div class="input-group-text">NGN</div>
                                    </div>
                                    <input type="text" class="form-control" value="{{old ('rate')}} " id="rate" name="rate" placeholder="Amount to be paid" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="quantity">Quantity &nbsp;<span class="requiredfield">*</span></label>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" value="{{old ('quantity')}} " id="quantity" name="quantity" placeholder="">
                                    <div class="input-group-prepend">
                                        <select name="uom" class="custom-select select2" id="uom">
                                        <option value="" selected>Select Measure</option>
                                        @foreach($uoms as $key => $uom)
                                            @if( old('uom') == $key)
                                                <option value="{{$key}}" selected> {{$uom}}</option>
                                            @else
                                                <option value="{{$key}}"> {{$uom}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                        @if ($errors->has('uom'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('uom') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
            jQuery(document).ready(function($){
                $('input[type="radio"]').click(function(){
                var demovalue = $(this).val();
                $("div.myDiv").hide();
                $("#show"+demovalue).show();
                });
                $('input[name="rate"]').keyup(function(event) {

                    // skip for arrow keys
                    if(event.which >= 37 && event.which <= 40) return;

                    // format number
                    $(this).val(function(index, value) {
                    return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    ;
                    });
                });
             });
         </script>

@endpush
