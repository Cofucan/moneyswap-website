{{-- modal begins--}}
<div class="modal fade" id="social-handle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-center">Create new Social Handle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('socialhandles.store') }}" id="CreateDesignation" enctype="multipart/form-data"> 
              {{csrf_field()}}
                  <input type="hidden" name="organization_id" id="organization_id" value="{{$portal->organization_id}}"> 
                  
                  <div class="form-group has-feedback">
                    <label for="social_platform_id">Platform<span class="text-muted"> *</span></label>
                      <select name="social_platform_id" class="custom-select select2 d-block w-100" id="social_platform_id" required>
                        @foreach($socialPlatforms as $key => $socialPlatform)
                          @if(old('social_platform_id') == $key)
                          <option value="{{$key}}" selected> {{$socialPlatform}}</option>
                          @else
                          <option value="{{$key}}"> {{$socialPlatform}}</option>
                          @endif
                        @endforeach
                      </select>
                                            
                    @if ($errors->has('social_platform_id'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('social_platform_id') }}</strong>
                      </span>
                    @endif
                </div>
      
                <div class="form-group has-feedback">
                  <label class="control-label" for="handle_name">Handle Name<span class="requiredfield">*</span></label>
                  <input type="text" class="form-control{{ $errors->has('handle_name') ? ' is-invalid' : '' }}" id="handle_name" name="handle_name"  required>
                                          
                  @if ($errors->has('handle_name'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('handle_name') }}</strong>
                    </span>
                  @endif
                </div>

                  <div class="modal-footer">
                  <button class="btn btn-success" type="submit">Save </button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
{{-- modal ends--}}


          
       