
<div class="modal fade" id="editprice{{ $price->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center">Edit {{$price->label}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('prices.update', $price) }}" id="UpdateDesignation" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="form-group">
                        <label class="control-label" for="label">Price Name &nbsp;<span class="requiredfield">*</span></label>
                        <input type="text" class="form-control" value="{{ $price->label }}" id="label" name="label" placeholder="Price Name" required>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="feature_id">Feature</label>
                                <select name="feature_id" id="feature_id" class="custom-select select2">
                                    <option value="">-- Optional --</option>
                                    @foreach(($features ?? []) as $feature)
                                        <option value="{{ $feature->id }}" @if((int) $price->feature_id === (int) $feature->id) selected @endif>
                                            {{ $feature->label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="cost_price">Cost Price</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">NGN</div>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $price->cost_price }}" id="cost_price" name="cost_price" placeholder="Amount to be paid">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="uom">Unit of Measure</label>
                                <input type="text" class="form-control" value="{{ $price->uom }}" id="uom" name="uom" placeholder="e.g. per month, per user">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="overview">Overview</label>
                        <textarea class="form-control" id="overview" name="overview" rows="3" placeholder="Short description of what is priced">{{ $price->overview }}</textarea>
                    </div>

                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input id="is_selling{{$price->id}}" name="is_selling" type="checkbox" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="is_selling{{$price->id}}">Is a billable product or service ? </label>
                        </div>
                    </div> -->

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
