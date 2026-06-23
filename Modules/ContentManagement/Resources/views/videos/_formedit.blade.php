
{{-- Edit Video modal begins--}}
         <div class="modal fade" id="edit{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-center">Edit {{ $video->label }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('videos.update', $video) }}" method="POST"  id="UpdateSection" enctype="multipart/form-data">
                  {{csrf_field()}}
                  @method('PUT')

                  <div class="form-group">
                        <label for="label">Video Title <span class="required">*</span></label>
                        <input type="text" name="label" value="{{$video->label}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" id="label" required/>
                        @if ($errors->has('label'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <label for="link">Video Link <span class="required">*</span></label>
                        <textarea name="link" class="form-control {{ $errors->has('link') ? ' is-invalid' : '' }}" rows="2" placeholder="Enter Youtube Link"  required>{!! $video->link !!} </textarea>
                        @if ($errors->has('link'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('link') }}</strong>
                            </span>
                        @endif
                    </div>

                  <div class="modal-footer">
                  <button class="btn btn-success" type="submit">Save </button>
                  {{--  <button class="btn btn-primary" type="reset">Reset</button>  --}}
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        {{-- modal ends--}}



