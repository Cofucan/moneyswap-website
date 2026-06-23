
{{-- New Stream modal begins--}}
<div class="modal fade" id="edit{{$requirement->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Update Requirement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                               
                <form action="{{ route('requirements.update', $requirement->id) }}" method="POST"  id="UpdateRequirement">
                    {{csrf_field()}}
                    @method('PUT')

                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="label">Label</label>        
                            <input type="text" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }} pull-right" name="label"  value="{{$requirement->label}}"/>      
                            @if ($errors->has('label'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('label') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>   
                    
                    <div class="form-group">
                        <label for="overview">Overview</label>
                        <textarea name="overview" class="form-control text-area" rows="4" placeholder="Enter Enter Post content"> {!! $requirement->overview !!} </textarea>
                        @if ($errors->has('overview'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('overview') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- modal ends--}} 