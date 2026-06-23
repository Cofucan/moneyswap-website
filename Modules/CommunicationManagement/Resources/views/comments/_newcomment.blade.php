<div class="modal fade" id="newcomment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Add Comment</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('comments.store') }}" id="CreateComment">
                    {{csrf_field()}} 
                    @if (isset($incident))
                        <input type="hidden" class="form-control" name="commentable_type" value="incidents">
                        <input type="hidden" class="form-control" name="incident_id" value="{{ $incident->id }}">
                    @elseif(isset($announcement))
                      <input type="hidden" class="form-control" name="commentable_type" value="announcements">
                      <input type="hidden" class="form-control" name="announcement_id" value="{{ $announcement->id }}">
                    @endif               
                

                    <div class="form-group">
                        <label for="comment_body">Your Comments</label>
                        <textarea name="comment_body" class="form-control" rows="4" placeholder="Add Comments" >{!! old('comment_body') !!}</textarea>
                        @if ($errors->has('comment_body'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('comment_body') }}</strong>
                            </span>
                        @endif
                    </div>                  

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Comments</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
