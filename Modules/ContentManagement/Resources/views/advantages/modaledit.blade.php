<div class="modal fade" id="edit{{ $advantage->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Update Advantage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">                
                <form action="{{ route('advantages.update', $advantage->id) }}" method="POST"  id="UpdateAdvantage{{ $advantage->id }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PUT')

                    <div class="form-group">
                        <label for="for_whom_{{ $advantage->id }}">For whom</label>
                        <select name="for_whom" id="for_whom_{{ $advantage->id }}" class="custom-select d-block w-100">
                            @foreach ($services as $service)
                                <option value="{{ $service }}" {{ $advantage->for_whom === $service ? 'selected' : '' }}>{{ $service }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="label">Title</label>
                        <input type="text" name="label" value="{{$advantage->label}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : ''}}">
                        @if ($errors->has('label'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('label') }}</strong>
                              </span>
                          @endif
                      </div>
          
                      <div class="form-row">
                        <div class="col-md-6 form-group">
                          <label for="display_image"> Display Image</label>
                          <input type="file" name="display_image" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}"/>
                          @if ($errors->has('display_image'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('display_image') }}</strong>
                              </span>
                          @endif
                          <small class="form-text text-muted">Leave blank to keep current image.</small>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="display_order"> Display Order</label>
                          <input type="number" name="sequence" value="{{ $advantage->sequence }}" class="form-control{{ $errors->has('sequence') ? ' is-invalid' : '' }}"/>
                          @if ($errors->has('sequence'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('sequence') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Current Image</label>
                        <div>
                            <img src="{{ asset($advantage->display_image ?: 'img/icons/upload-img.jpg') }}" alt="{{ $advantage->label }}" style="width:64px;height:64px;border-radius:10px;object-fit:cover;border:1px solid #e2e8f0;">
                        </div>
                      </div>
                    
                    <div class="form-group ">
                        <label for="overview">Overview</label>
                        <textarea name="overview" class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" rows="4">{!! $advantage->overview !!} </textarea>
                        @if ($errors->has('overview'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('overview') }}</strong>
                            </span>
                        @endif
                      </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="published_{{ $advantage->id }}" name="published" {{ $advantage->published ? 'checked' : '' }}>
                            <label class="custom-control-label" for="published_{{ $advantage->id }}">Published</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button class="btn btn-success btn-sm btn-block" type="submit">Update </button>
                        </div>
                    </div>
                </form>  
            </div>
            
        </div>
    </div>
</div>
