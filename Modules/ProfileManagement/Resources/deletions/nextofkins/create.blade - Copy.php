@extends('layouts.app')

@section('content')
<div class="container">

        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Community <small>Use the form below to enter a new record</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if ($errors->any())
                      <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                                </ul>
                      </div>
                    @endif
                    <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" >
                        {{csrf_field()}}
                        
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                              <label>Community Type</label>
                              <select name='community_type_id' class="form-control select2"  data-placeholder="Select community type">
                                <option>Engineering</option>
                                
                              </select>
                            </div>
                        </div>
                            <div class="row">              
                      <div class=" col-xs-12 col-sm-12 col-md-12 form-group has-feedback">
                        <label>Community Name</label>
                        <input type="email" class="form-control" placeholder="Enter property name">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>State Located</label>
                      <select class="form-control select2"  data-placeholder="Select location"
                                      >
                                <option>Alabama</option>
                                <option>Add New</option>
                                <option>Alaska</option>
                                <option>Texas</option>
                                <option>Washington</option>
                                <optgroup>Add New</optgroup>
                              </select>
                        <span class="fa fa-map form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>City Located</label>
                              <select name='project_type_id' class="form-control select2"  data-placeholder="Select project type"
                                      style="width: 100%;">
                                <option>Engineering</option>
                                <option>Construction</option>
                                <option>Add New</option>
                              </select>
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                      <div class="input-group">
                             <div class="input-group-btn">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Select <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="#">Plot</a> </li>
                                <li><a href="#">No</a> </li>                                
                              </ul>
                            </div>
                            <input type="text" class="form-control has-feedback-right" id="inputSuccess4" placeholder="Email">
                        
                            <!-- /btn-group -->
                          </div>
                        
                      </div>
                    
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" id="inputSuccess5" placeholder="Street Address">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="row">              
                      <div class="col-xs-12 col-sm-12 col-md-12 form-group has-feedback">
                        <label>Property Description</label>
                        <textarea class="resizable_textarea form-control" placeholder="This text area automatically resizes its height as you fill in more text courtesy of autosize-master it out..."></textarea>
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>       
                    </div>
                      <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                        <label>Avarter</label>
                        <input id="avatar" type="file" class="form-control" name="avatar">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>     
                     </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          
						   <button class="btn btn-primary" type="reset">Save and add new</button>
                          <button type="submit" class="btn btn-success">Save and close</button>
                          <button type="button" class="btn btn-primary">Cancel</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>
@endsection
