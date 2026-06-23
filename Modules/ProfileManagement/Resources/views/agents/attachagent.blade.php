<span class="span">Sponsor Details</span>
                <hr>
                <div class="form-row mb-2">

                    <div class="col-md-12 mb-3 form-group">
                      <div class="custom-control custom-radio custom-control-inline">
                          <input id="create" name="profile" type="radio" value="Create" class="custom-control-input" required>
                          <label class="custom-control-label" for="create">Add to existing Sponsor</label>
                      </div>

                      <div class="custom-control custom-radio custom-control-inline">
                              <input id="new" name="profile" type="radio" value="New" class="custom-control-input" required>
                              <label class="custom-control-label" for="new">Create New Sponsor Profile </label>
                      </div>
                    <div class="mb-3 form-group">
                        <select name="relationship_id" class="custom-select d-block w-100 select2" id="relationship">
                            <option value="">Relationship with Orphan</option>
                            @foreach($relationships as $key => $relationship)
                            @if(old('relationship_id') == $key)
                            <option value="{{$key}}" selected> {{$relationship}}</option>
                            @else
                            <option value="{{$key}}"> {{$relationship}}</option>
                            @endif
                        @endforeach
                        </select>
                        @if ($errors->has('relationship_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('relationship_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>
                  <div class="col-md-12">
                      <div id="showCreate" class="myDiv">
                          <div class="form-group">
                            <label for="agent_id">Sponsor Name</label>
                            <select name="agent_id" class="custom-select d-block w-100 select2 {{ $errors->has('agent_id') ? ' is-invalid' : '' }}" id="agent">
                              <option value=""> Select Sponsor</option>
                              @foreach($agents as $agent)
                              <option value="{{$agent->id}}"> {{$agent->representative}}</option>
                              @endforeach
                          </select>
                          </div>
                      </div>
                      <div id="showNew" class="myDiv">
                        <div class="mb-3 form-row">
                          <div class="col-md-6 input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-user-o"></i></div>
                              </div>
                              <input id="agent_lastname" value="{{ old('agent_lastname') }}" type="text" class="form-control{{ $errors->has('agent_lastname') ? ' is-invalid' : '' }}" name="agent_lastname" placeholder="Sponsor Last Name">

                                  @if ($errors->has('agent_lastname'))
                                  <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('agent_lastname') }}</strong>
                                  </span>
                              @endif
                          </div>

                          <div class="col-md-6 input-group">
                            <input id="agent_firstname" value="{{ old('agent_firstname') }}" type="text" class="form-control{{ $errors->has('agent_firstname') ? ' is-invalid' : '' }}" name="agent_firstname" placeholder="Agent First Name">

                            @if ($errors->has('agent_firstname'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('agent_firstname') }}</strong>
                            </span>
                            @endif
                        </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-6 mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                                </div>
                                <input id="email" type="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="E-mail Address">
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="col-md-6 mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                </div>
                                <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" placeholder="Telephone" value="{{ old('telephone') }}">
                            </div>
                            @if ($errors->has('telephone'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('telephone') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
