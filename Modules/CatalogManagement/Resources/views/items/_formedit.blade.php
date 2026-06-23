
<div class="modal fade" id="edititem{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center">Edit {{$item->label}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('items.update', $item) }}" id="UpdateDesignation" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="form-group">
                        <label class="control-label" for="cost_price">Item Name &nbsp;<span class="requiredfield">*</span></label>
                        <input type="text" class="form-control" value="{{$item->label}} " id="label" name="label" placeholder="Item Name" required>

                    </div>

                
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label" for="cost_price">Cost Price &nbsp;<span class="requiredfield">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">NGN</div>

                                </div>
                                <input type="text" class="form-control" value="{{$item->cost_price}} " id="cost_price" name="cost_price" placeholder="item cost_price">
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="quantity">Measure</label>
                                <select name="uom" class="custom-select select2" id="uom">
                                    <option ></option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input id="is_selling{{$item->id}}" name="is_selling" type="checkbox" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="is_selling{{$item->id}}">Is a billable product or service ? </label>
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
