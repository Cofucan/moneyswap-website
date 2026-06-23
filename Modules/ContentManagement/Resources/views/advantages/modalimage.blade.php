<div class="modal fade" id="image{{ $advantage->id }}" tabindex="-1" role="dialog" aria-labelledby="changeImageLabel{{ $advantage->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeImageLabel{{ $advantage->id }}">Change Advantage Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('advantages.changeimage') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="advantage_id" value="{{ $advantage->id }}">

                    <div class="form-group">
                        <label>Current Image</label>
                        <div>
                            <img src="{{ asset($advantage->display_image ?: 'img/icons/upload-img.jpg') }}" alt="{{ $advantage->label }}" style="width:80px;height:80px;border-radius:12px;object-fit:cover;border:1px solid #e2e8f0;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="display_image_{{ $advantage->id }}">New Image</label>
                        <input type="file" name="display_image" id="display_image_{{ $advantage->id }}" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}" required>
                        @if ($errors->has('display_image'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('display_image') }}</strong>
                            </span>
                        @endif
                        <small class="form-text text-muted">JPEG/PNG/GIF up to 1MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Image</button>
                </div>
            </form>
        </div>
    </div>
</div>
