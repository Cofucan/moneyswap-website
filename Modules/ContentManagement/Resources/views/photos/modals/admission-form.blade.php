    <div class="modal animate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" id="animate">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Admission </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body text-left p-lg">
                    <form class="">
                        <span>Child Info</span>
                        
                        <div class="mb-3 form-group">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-user-o"></i></div>
                              </div>
                              <input id="child_name" type="text" class="form-control{{ $errors->has('child_name') ? ' is-invalid' : '' }}" name="child_name" placeholder="Name of Child" required autofocus>
                          </div>
                          

                          @if ($errors->has('child_name'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('child_name') }}</strong>
                              </span>
                          @endif
                        </div> 

                        <div class="form-row">
                            <div class="col-md-6 mb-3 form-group">
                                <label class="control-label" for="date_of_birth">Date of Birth</label>
                                <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" placeholder="Date of Birth" required autofocus>
                                
                                @if ($errors->has('date_of_birth'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                           
                            </div> 

                            <div class="col-md-6 mb-3 form-group">
                                <label class="control-label" for="gender">Gender</label>
                                <select name="gender" class="custom-select d-block w-100" id="gender" required>
                                    <option value="gender">Male</option>  
                                    <option>Female</option>      
                                </select>
                                

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                           
                            </div> 
                           
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3 form-group">
                               <label class="control-label" for="last_class">Last Class</label>
                               <input id="last_class" type="text" class="form-control{{ $errors->has('last_class') ? ' is-invalid' : '' }}" name="last_class" required autofocus>
                                

                                @if ($errors->has('last_class'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_class') }}</strong>
                                    </span>
                                @endif 
                           
                            </div> 

                            <div class="col-md-6 mb-3 form-group">
                                <label class="control-label" for="admission_last">Admission Last</label>
                                <input id="admission_last" type="date" class="form-control{{ $errors->has('admission_last') ? ' is-invalid' : '' }}" name="admission_last" >
                                @if ($errors->has('admission_last'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('admission_last') }}</strong>
                                    </span>
                                @endif
                           
                            </div> 
                           
                        </div>

                        <div class="mb-3 form-group">
                            <label class="control-label" for="school">School</label>
                          <select name="school" class="custom-select d-block w-100" id="school" required>
                              <option value="school"> </option>  
                              <option>Creche</option> 
                              <option>Nursery</option> 
                              <option>Primary</option> 
                              <option>College</option>      
                          </select>
                          

                          @if ($errors->has('school'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('school') }}</strong>
                              </span>
                          @endif
                        </div> 
                        <hr>

                        <span >Guardian/Parent Info</span>
                        
                        <div class="mb-3 form-group">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-user-o"></i></div>
                              </div>
                              <input id="parent_name" type="text" class="form-control{{ $errors->has('parent_name') ? ' is-invalid' : '' }}" name="parent_name" placeholder="Guardian/Parent Name" required autofocus>
                          </div>
                          

                          @if ($errors->has('parent_name'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('parent_name') }}</strong>
                              </span>
                          @endif
                        </div> 

                        <div class="mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                                <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" placeholder="Address" required autofocus>
                            </div>
                            

                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3 form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                                    </div>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="E-mail Address" required autofocus>
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
                                    <input id="tel" type="tel" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="email" placeholder="Telephone" required autofocus>
                                </div>
                                

                                @if ($errors->has('tel'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                @endif
                            </div> 
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <!-- The Modal -->