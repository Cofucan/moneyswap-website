 {{-- modal begins--}}
 <div class="modal fade" id="edit{{$itemcategory->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center">Edit {{$itemcategory->label}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('itemcategories.update', $itemcategory) }}" id="UpdateDesignation" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="label">Category  </label>
                        <input type="text" name="label" value="{{$itemcategory->label}}" class="form-control" placeholder="Enter EmployeeCategory Code"  id="label" />
                        @if ($errors->has('label'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>
                
                    <div class="form-group ">
                        <label for="overview"> Description</label>
                        <textarea name="overview" class="form-control">{!! $itemcategory->overview !!}</textarea>
                        @if ($errors->has('overview'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('overview') }}</strong>
                            </span>
                        @endif
                    </div>
                
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input id="published" name="published" type="checkbox" value="1" class="custom-control-input" checked>
                        <label class="custom-control-label" for="published">Publish</label>
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