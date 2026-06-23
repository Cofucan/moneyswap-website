
{{-- modal begins--}}
<div class="modal fade" id="reject{{ $document->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center"> Rejection Reason</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('requireddocuments.process') }}" method="POST"
                onsubmit="return confirm('Are you sure you want to Rejct this Document ?');">
                {{csrf_field()}}                                            
                    <input type="hidden" name="required_document_id" value="{{ $document->id}}" class="form-control" />
                    <input type="hidden" name="objectionable_id" value="{{ $document->id}}" class="form-control" />
                    <input type="hidden" name="objectionable_type" value="Document" class="form-control" />
                
                    <div class="form-group">
                        <label for="reason"> Reason for Rejection</label>
                        <textarea name="reason" class="form-control">{!! old('reason') !!}</textarea>
                        @if ($errors->has('reason'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('reason') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm" name="status" value="Rejected"> Send Back</button>                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal ends--}} 