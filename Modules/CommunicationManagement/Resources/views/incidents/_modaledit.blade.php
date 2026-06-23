<div class="modal fade" id="editincident{{ $incident->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Edit Incident</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('incidents.update', $incident->slug) }}" id="UpdateIncident">
                    {{csrf_field()}}
                    @method('PUT')

                    <div class="form-group">
                        <label for="label">Labeln</label>
                        <input type="text" name="label" value="{{ $incident->label }}" class="form-control"  id="label" />
                        @if ($errors->has('label '))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="overview">Answer</label>
                        <textarea name="overview" class="form-control" rows="7" placeholder="Response" id="textarea">{!! $incident->overview !!}</textarea>
                        @if ($errors->has('overview'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('overview') }}</strong>
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

@include('partials.summernote')