{{-- address modal begins--}}
  <div class="modal fade" id="editvalue{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title text-center">Add new Value</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('corevalues.update', $value->id) }}" method="POST"  id="UpdateCoreValue" enctype="multipart/form-data">
                  {{csrf_field()}}
                  @method('PUT')

                    <div class="form-group">
                      <label for="value_title">Title</label>
                      <input type="text" name="value_title" value="{{$value->value_title}}" class="form-control{{ $errors->has('value_title') ? ' is-invalid' : ''}}">
                      @if ($errors->has('value_title'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('value_title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-row">
                      <div class="col-md-6 form-group">
                        <label for="display_image"> Display Image</label>
                        <input type="file" name="display_image" value="{{$value->display_image}}" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}"/>
                        @if ($errors->has('display_image'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('display_image') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="display_order"> Display Order</label>
                        <input type="number" name="display_order" value="{{$value->display_order}}" class="form-control{{ $errors->has('display_order') ? ' is-invalid' : '' }}"/>
                        @if ($errors->has('display_order'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('display_order') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  
                    <div class="form-group ">
                      <label for="summary">Summary</label>
                      <textarea name="summary" class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}">{!! $value->summary !!} </textarea>
                      @if ($errors->has('summary'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('summary') }}</strong>
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
{{-- modal ends--}} 