@extends('layouts.admin')
@section('page_title', $profile->last_name )
@push('styles')
<link href="{{ asset('css/tab.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endpush
@section('content')

<section>
  <div class="container">
      <nav aria-label ="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
              @if (Auth::user()->Profile->role_id == 1)
              <li class="breadcrumb-item" aria-current="page"><a href="{{ url('profiles/home') }}">Profiles</a></li>
              @endif
              <li class="breadcrumb-item active" aria-current="page">{{ $profile->full_name }}</li>
              <div class="ml-auto mr-0">
                {{-- @if ($profile->status <> 'Approved')
                 <a class="btn btn-primary btn-sm" href="#edit" data-toggle="modal" data-target="#edit">Edit</a>
                @endif --}}
          @if (Auth::user()->Profile->role_id == 1 && $profile->status <> 'Approved')
            {{-- <div class="col-md-4 col-7 col-sm-3"> --}}
              <form action="{{ route('profiles.process') }}" method="post"
                onsubmit="return confirm('Are you sure you want to approve this profile?');">
                <input type="hidden" name="profile_id" value="{{$profile->id}}" />
                {{ csrf_field() }}
                <button type="submit" name="status" class="btn btn-sm btn-success action_btn" value="Approved"> Approve</button>
              </form>
            {{-- </div> --}}
          @endif
              </div>
          </ol>
          {{-- modal begins--}}
          <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title text-center">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form method="POST" action="{{ route('profiles.update',  $profile->referral_code) }}" id="Updateprofile">
                        {{csrf_field()}}
                        @method('PUT')

                        @include('profiles._formedit')
                        <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
          </div>
          {{-- modal ends--}}
      </nav>
      <div class="row mt-3"> 
       <div class="col-md-10">
        <h4>{{ $profile->full_name }}</h4>
        
        <div class="row">
          <div class="col-md-3">
              @if (Auth::user()->profile_id == $profile->id)
                <form action="{{ route('profiles.changephoto') }}" method="POST" enctype="multipart/form-data" >
                  {{csrf_field()}}
                  <input type="hidden" name="profile_id" value="{{ $profile->id }}">
                    <div class="input-group mb-3">
                      <img src="{{ asset ($profile->profile_pic ) }}" alt="Photograph" class="img-circle w-100" height="200px">
                      <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('display_image') ? ' is-invalid' : '' }}" required>
                      <div class="input-group-append" id="button-addon4">
                        <button type="submit" class="btn btn-sm btn-primary btn-block">
                          {{ __('Change') }}
                        </button>
                      </div>
                    </div>
                </form> 
              @else    
              <img src="{{ asset ($profile->profile_pic ) }}" alt="Photograph" class="img-circle w-100" height="200px">

              @endif 
              <hr>           
           
            <a href="tel:{{ $profile->DefaultPhone->phone_number}}" class="btn btn-primary btn-sm mr-3"> <i class="fa fa-phone"></i> Call</a>
            <a href="mailto:{{ $profile->User->email}}" class="btn btn-primary btn-sm"> <i class="fa fa-envelope"></i> Email</a>
            <table class="table table-borderless">
              <tr>                     
                  <td><strong>Email: </strong></span>{{ $profile->User->email }}</td>               
              </tr>
              <tr>
                <td><strong>Telephone:</strong></span> {{$profile->DefaultPhone->phone_number ?? 'None'}}</td>
              </tr>
              <tr>
                  <td><strong>Gender:</strong></span> {{$profile->gender}}</td>            
              </tr>
              <tr>
                  <td><strong>Date of Birth:</strong></span> {{$profile->birthday ?? 'N/A'}}</td>         
              </tr>
              <tr>
                  <td><strong>Status:</strong></span> {{$profile->status}}</td>
              </tr>
            </table>
          
          </div>
          <div class="col-md-9">
            <div class="card">            
              <nav>
                  <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
                      <a class="nav-item nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">Contacts</a>
                      @if ($profile->id == Auth::user()->profile_id)
                        <a class="nav-item nav-link" id="secrets-tab" data-toggle="tab" href="#secrets" role="tab" aria-controls="secrets" aria-selected="false">Transaction Pin</a>
                      @elseif(Auth::user()->Profile->role_id == 1 )
                        <a class="nav-item nav-link" id="causes-tab" data-toggle="tab" href="#causes" role="tab" aria-controls="causes" aria-selected="false">Wallets</a>
                      @endif
                  </div>
              </nav>
              <div class="card-body">
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                  {{-- secrets-tab --}}
                  <div class="tab-pane fade" id="secrets" role="tabpanel" aria-labelledby="secrets-tab">
                    <div class="row mt-4">
                      <div class="col-md-12">
                        <h5>Transaction Pin</h5> 
                        <table class="table table-bordered">
                            <tr>
                              <th>XXXXX</th>
                              <td>
                                <a href="#changepin" class="btn btn-danger" data-target="#changepin" data-toggle="modal">Change Pin</a>
                              </td>
                            </tr>
                        </table>
                                                      
                      </div>
                    </div>
                  </div>

                   {{-- secrets-tab --}}
                   <div class="tab-pane fade" id="causes" role="tabpanel" aria-labelledby="secrets-tab">
                    <div class="row mt-4">
                      <div class="col-md-12">
                        <h5>Wallets</h5> 
                        <table class="table table-borderless">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Cause</th>
                              <th>Av. Balance</th>
                              <td>Action</td>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($profile->causes as $cause)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cause->currency_code }}</td>
                                <td>{{ $cause->available_balance }}</td>
                                <td>
                                  <div class="row">

                                  </div>
                                </td>
                              </tr>
                          @endforeach
                          </tbody>
                          
                          
                        </table>
                                                      
                      </div>
                    </div>
                  </div>
                
                  {{-- student info-tab --}}
                  <div class="tab-pane fade show active" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                      <div class="row mt-4">
                        <div class="col-md-12">
                          <h5>{{$profile->full_name}}'s documents</h5> 
                          <div class="row">
                            @foreach ($profile->requireddocuments as $document)
                            <div class="col-md-6">
                              <div class="card">
                                <img src="{{ asset($document->front) }}" alt="" class="w-100" height="150px">
                                <div class="card-body">
                                  {{-- <div class="row"></div> --}}
                                  <a class="btn btn-success btn-sm" href="#view{{ $document->id }}" data-toggle="modal" data-target="#view{{ $document->id }}">View Details</a>
                                  @if($document->status == 'Rejected' && $document->profile_id == Auth::user()->profile_id)
                                  <a class="btn btn-danger btn-sm ml-3" href="#edit{{ $document->id }}" data-toggle="modal" data-target="#edit{{ $document->id }}">Update Document</a>
                                  @include('requireddocuments._formedit')
                                  @endif
                                </div>
                              </div>
                            </div> 
                            @include('requireddocuments._details')
                            @include('requireddocuments._approve')
                            @include('requireddocuments.reject')
                          @endforeach
                          </div>                     
                        
                            {{-- <table class="table table-borderless">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>Documents</th>   
                                  <th>Status</th>                           
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($profile->requireddocuments as $document)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $document->document_name }}</td>
                                  <td>{{ $document->status }}</td>
                                  <td>
                                    <a class="btn btn-success btn-sm" href="#view{{ $document->id }}" data-toggle="modal" data-target="#view{{ $document->id }}">View Details</a>
  
                                  </td>
                                </tr>
                                @include('requireddocuments._details')
                                @include('requireddocuments._approve')
                                @endforeach
                              </tbody>
                              
                              
                            </table>                                  --}}
                        </div>
                      </div>
                  </div>
  
                  {{-- Contact tab --}}
                  <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                      {{-- <div class="row mt-3 p-l-10 p-r-10">
                        <div class="col-md-12">
                          <div class="pull-left">
                            <h5>Telephones</h5>
                            </div>
                            <button type="button" class="btn btn-success btn-sm mb-3 pull-right" data-toggle="modal" data-target="#new-contact">
                              Add New Telephone
                            </button>
                            
                            <table class="table table-borderless">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>Telephone</th>
                                  <th>Tag</th>
                                  <td>Action</td>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($profile->telephones as $telephone)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>+{{ $telephone->phone_number }}</td>
                                    <td>{{ $telephone->phone_tag }}</td>
                                    <td>
                                      <div class="row">
  
                                      </div>
                                    </td>
                                  </tr>
                              @endforeach
                              </tbody>
                              
                              
                            </table>
                
                        </div>
                      </div> --}}
                      <div class="row mt-3 p-l-10 p-r-10">
                        <div class="col-md-12">
                          <div class="pull-left">
                          <h5> Address</h5>
                          </div>
                            <button type="button" class="btn btn-success btn-sm mb-3 pull-right" data-toggle="modal" data-target="#new-address">
                              Add Address
                            </button>
                            {{--editmodal begins--}}
                              <div class="modal fade" id="new-address" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title text-center">Add Address</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form method="POST" action="{{ route('addresses.store') }}" id="AddAddress">
                                          {{csrf_field()}}
                                          <input type="hidden" name="profile_id" value="{{$profile->id}}">
                                          @include('addresses._form')              
                                          <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Save </button>
                                          </div>
                                        </form>                
                                      </div>
                                    </div>
                                </div>
                              </div>
                          {{-- modal ends--}}
                            <table class="table table-borderless">  
                              <thead>
                                <tr>
                                  <th>Address</th>
                                  <th>Action</th>
                                </tr>
                              </thead>                        
                              <tbody>                              
                                @foreach ($profile->addresses as $address)
                                    <tr>
                                      <td>{{ $address->full_address }}</td>
                                      <td>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <a href="#editaddress{{ $address->id }}" data-target="#editaddress{{ $address->id }}" data-toggle="modal" class="btn btn-primary btn-sm">Edit</a>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                @endforeach
                              </tbody>
                              
                              
                            </table>
                
                        </div>
                      </div>
                  </div>
                </div>
  
              </div>
            </div>
          </div>
         </div>
       </div>
      </div>

  </div>
</section>
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
