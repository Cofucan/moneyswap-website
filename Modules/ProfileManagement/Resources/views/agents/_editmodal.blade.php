 <a class="pull-right" data-toggle="modal" data-target="#edit{{ $agent->id}}" href="#edit{{ $agent->id}}">
                                        Edit
                                    </a>
 {{-- modal begins--}}
 <div class="modal fade" id="edit{{$agent->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-center">Edit {{$agent->representative}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('agents.update', $agent) }}" id="Updatefamily">
                  {{csrf_field()}}
                  @method('PUT')

                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" for="occupation">Occupation</label>
                        <input type="text" class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" id="occupation" name="occupation" value="{{ $agent->occupation }}">
                        @if ($errors->has('occupation '))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('occupation') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="annual_income" class="label-control">Annual Income</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">NGN</div>
                          </div>
                          <input type="text" value="{{ $agent->annual_income }}" class="form-control{{ $errors->has('annual_income') ? ' is-invalid' : '' }}" id="annual_income" name="annual_income">
                        </div>

                        @if ($errors->has('annual_income'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('annual_income') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                  <button class="btn btn-success" type="submit">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
{{-- modal ends--}}
