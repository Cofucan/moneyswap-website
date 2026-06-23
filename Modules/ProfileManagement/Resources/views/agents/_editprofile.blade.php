  <a class="pull-right" data-toggle="modal" data-target="#editprofile" href="#editprofile">
                                        Edit
                                    </a>
 {{-- modal begins--}}
 <div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-center">Edit {{$agent->representative}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('profiles.update', $agent->Profile) }}" id="Updatefamily">
                  {{csrf_field()}}
                  @method('PUT')

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="last_name" class="control-label"> Name</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <select id="salutation" name="salutation" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a salutation ...">
                                <option value="Mr" selected> Mr </option>
                                <option value="Mrs"> Mrs </option>
                                <option value="Miss">Miss </option>
                            </select>
                          </div>
                          <input type="text" name="last_name" value="{{$agent->Profile->last_name }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" placeholder="Last Name"required>
                        </div>
                        @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="first_name" class="control-label">.</label>
                      <input type="text" name="first_name" value="{{$agent->Profile->first_name }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="First Name">

                        @if ($errors->has('first_name'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                        @endif
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="middle_name" class="control-label">.</label>
                      <input type="text" name="middle_name" value="{{$agent->Profile->middle_name}}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name" placeholder="Other Names">

                        @if ($errors->has('middle_name'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('middle_name') }}</strong>
                          </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                <label for="email" class="label-control">Contact Email</label>
                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ $agent->profile->email }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
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
