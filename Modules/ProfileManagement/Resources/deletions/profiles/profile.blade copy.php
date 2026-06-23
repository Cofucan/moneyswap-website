@extends('layouts.admin')
@section('page_title', 'Balogun Abiodun Wesley')
{{-- @section('page_title', $profile->last_name ) --}}
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/profile.css') }}">
@endpush
@section('content')


 
    <div class="container-fluid">
      <div class="row ">
        <div class="col-md-7 content_title">
          <h4>{{ Auth::user()->full_name }}</h4>
        </div>
        <div class="col-md-3">

          <div class="page_button text-right">
            {{--  <a class="btn btn-sm btn-primary" href="{{ route('people.edit',$profile->id) }}"><i class="fa fa-pencil"></i> Edit Profile</a>  --}}
          </div>
        </div>
      </div>
    
      <div class="row mt-4 mb-5">
        
        <div class="col-md-3"><!--left col-->
                

          <div class="text-center ">
            <form action="{{ route('people.changephoto') }}" method="POST" enctype="multipart/form-data" >

              {{csrf_field()}}
              <input type="hidden" name="person_id" value="{{  Auth::user()->Person->id }}">
              <div class="input-group mb-3">
                  <img src="{{ asset (Auth::user()->Person->avatar) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
                  <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
                  <div class="input-group-append" id="button-addon4">
                  <button type="submit" class="btn btn-sm btn-primary btn-block">
                      {{ __('Change') }}
                  </button>
                  </div>
              </div>
          </form>
          
        
        </div><hr><br>
      
            
          </div><!--/col-3-->
          <div class="col-md-9 personal-info">
            <h5 class="mt-1 text-muted">Login Info</h5>
            <table class="table table-bordered">
                
                <tr>
                    <td width="40%">
                      <div class="row">
                        <div class="col-md-9">
                          <strong>Email:</strong><br>
                          {{  Auth::user()->email }}
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-edit" data-toggle="modal" data-target="#ChangeEmail">
                              <span class="text-success"> <i class="fa fa-edit"></i>  </span> 
                            </button>
                        </div>
                      </div>  
                    </td>
                    
                    <td width="30%">
                      <div class="row">
                        <div class="col-md-9">
                          <strong>Telephone:</strong><br>
                          {{  Auth::user()->telephone }}
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-edit" data-toggle="modal" data-target="#ChangePhone">
                              <span class="text-success"> <i class="fa fa-edit"></i>  </span> 
                            </button>
                        </div>
                      </div>  
                    </td>
                    
                    <td width="30%">
                      <div class="row">
                        <div class="col-md-9">
                          <strong>Password:</strong><br>
                          XXXXXXXXX
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-edit" data-toggle="modal" data-target="#Changepassword">
                              <span class="text-success"> <i class="fa fa-edit"></i>  </span> 
                            </button>
                        </div>
                      </div>  
                    </td>
                </tr>
                          
            </table>
            
            <h5 class="pull-left">Personal Info</h5>
            <button type="button" class="btn btn-primary btn-sm mb-3 pull-right" data-toggle="modal" data-target="#profile">
                <i class="fa fa-edit"></i> Edit
            </button>
          
            <table class="table table-bordered">
                
                <tr>
                    <td width="33%"><strong>Full Name:</strong> {{ Auth::user()->full_name }}</td>
                    <td width="33%"><strong>State of Origin:</strong></span> {{ Auth::user()->Person->state_of_origin_id }}</td>
                    <td width="33%"><strong>Marital Status:</strong></span> {{ Auth::user()->Person->birth_sequence }}</td>
                </tr>
                <tr>
                    <td><strong>Gender:</strong></span> {{  Auth::user()->Person->gender }}</td>
                    <td><strong>Place of birth:</strong></span> {{ Auth::user()->Person->place_of_birth }}</td>
                    <td><strong>Birth Sequence:</strong></span> {{ Auth::user()->Person->birth_sequence }}</td>
                </tr>
                <tr>
                    <td><strong>DOB:</strong> </td>
                    <td><strong>Religion:</strong></span> {{  Auth::user()->Person->religion }}</td>
                    <td><strong>Primary Lang.</strong></span> {{ Auth::user()->Person->primary_language }}</td>
                </tr>
                <tr>
                  <td colspan="3"><strong>About:</strong></span> {{ Auth::user()->Person->bio }}</td>
                </tr>
            </table>
            
            
          </div>
          
      </div>

      {{-- profile modal begins--}}
        <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title text-center">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="{{ route('people.store') }}" id="CreatePerson" enctype="multipart/form-data">
                    {{csrf_field()}}
                      <input type="hidden" name="person_id" value="{{  Auth::user()->Person->id }}">
                      
                      @include('people._completeform')
                  
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

      {{-- email modal begins--}}
        <div class="modal fade" id="ChangeEmail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title text-center">Edit Email</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="{{ route('registrationdocuments.store') }}" id="RegistrationDocuments" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <input type="hidden" name="person_id" value="{{  Auth::user()->Person->id }}">
                      
                      <div class="mb-3">
                          <label for="email">{{ __('E-Mail Address') }}</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                              </div>
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{  Auth::user()->email }}" required autofocus>
                          </div>
                          @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                  
                      <div class="modal-footer">
                          <button class="btn btn-success" type="submit">Change </button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                      </div>
                  </form>
              
              </div>
            </div>
          </div>
        </div>
      {{-- modal ends--}}

      {{-- telephone modal begins--}}
        <div class="modal fade" id="ChangePhone" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title text-center">Change Telephone</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="{{ route('registrationdocuments.store') }}" id="RegistrationDocuments" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <input type="hidden" name="person_id" value="{{  Auth::user()->Person->id }}">
                      
                      <div class="mb-3">
                          <label for="telephone">Telephone</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <select id="country_code" name="country_code" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a country_code ...">
                                      <option value="+234" selected> +234 </option>
                                      <option value="+1"> +1 </option>
                                      <option value="+44"> +44 </option>
                                      <option value="+971"> +971 </option>
                                      <option value="+233"> +233 </option>
                                      <option value="+20"> +20 </option>
                                  </select>
                              </div>

                              <input type="text" id="telephone" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{  Auth::user()->phone }}" placeholder="Mobile Telephone Number" required>
                          </div>
                          @if ($errors->has('telephone'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('telephone') }}</strong>
                                  </span>
                              @endif
                      </div>
                  
                      <div class="modal-footer">
                          <button class="btn btn-success" type="submit">Change </button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                      </div>
                  </form>
              
              </div>
            </div>
          </div>
        </div>
      {{-- modal ends--}}

      {{-- password modal begins--}}
        <div class="modal fade" id="Changepassword" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title text-center">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="" id="RegistrationDocuments" >
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="{{  Auth::user()->id }}">

                        <div class="form-group mb-3">
                          <label for="password">Old Password</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-lock"></i></div>
                              </div>
                              <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                          </div>

                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                        </div>
                        
                        <div class="form-group mb-3">
                          <label for="password">New Password</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-lock"></i></div>
                              </div>
                              <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                          </div>

                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                </div>
                                <input id="password-confirm" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                            </div>

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
    </div>

@endsection

@push('scripts')
<script>
  $(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
    });
});
</script>

 @endpush
