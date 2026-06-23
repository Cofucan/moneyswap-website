<div class="modal fade" id="edit{{ $testimonial->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Update Investment Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST"  id="UpdateInvestmentPlan">
                    {{csrf_field()}}
                    @method('PUT')

                    <div class="form-group">
                        <label for="label">Title</label>
                        <input type="text" name="label" value="{{$testimonial->label}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : ''}}">
                        @if ($errors->has('label'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('label') }}</strong>
                              </span>
                          @endif
                      </div>

                      {{-- <div class="form-row">
                        <div class="col-md-6 form-group">
                          <label for="display_image"> Display Image</label>
                          <input type="file" name="display_image" value="{{ $testimonial->display_image}}" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}"/>
                          @if ($errors->has('display_image'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('display_image') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="display_order"> Display Order</label>
                          <input type="number" name="display_order" value="{{ $testimonial->display_order}}" class="form-control{{ $errors->has('display_order') ? ' is-invalid' : '' }}"/>
                          @if ($errors->has('display_order'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('display_order') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div> --}}

                      <div class="form-group ">
                        <label for="testimony">Overview</label>
                        <textarea name="testimony" class="form-control{{ $errors->has('testimony') ? ' is-invalid' : '' }}" rows="4">{!! $testimonial->testimony !!} </textarea>
                        @if ($errors->has('testimony'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('testimony') }}</strong>
                            </span>
                        @endif
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
