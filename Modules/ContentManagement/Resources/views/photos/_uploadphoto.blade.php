
<div class="modal fade" id="uploadphoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Upload Photo</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Select multiple images to be added, image must not exceed 1MB </p>
                <form method="POST" action="{{ route('photos.store') }}" id="CreatePhoto" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    @if (isset($event))
                        <input type="hidden" class="form-control" name="owner_type" value="events">
                        <input type="hidden" class="form-control" name="owner_id" value="{{$event->id}}">
                    @elseif(isset($club))
                        <input type="hidden" class="form-control" name="owner_type" value="clubs">
                        <input type="hidden" class="form-control" name="owner_id" value="{{$club->id}}">
                    @endif

                    
                    <div class="form-group">
                        <input type="file" name="display_media[]" class="form-control-file" multiple="true">
                    </div>
                   
                    <div class="modal-footer">
                        <button class="btn btn-primary px-3" type="submit">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>