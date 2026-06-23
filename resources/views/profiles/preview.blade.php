@extends('layouts.admin')
@section('page_title', $profile->last_name )
@push('styles')
<link href="{{ asset('css/tab.css') }}" rel="stylesheet">
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
             
          </ol>
         
      </nav>
      <div class="row mt-3"> 
        <div class="col-md-10">
          <h5>Bio Data</h5>
          <div class="row">
            <div class="col-md-3"> 
              <img src="{{ asset ($profile->profile_pic ) }}" alt="Photograph" class="img-circle w-100" height="200px">
            </div>
            <div class="col-md-9">
              <h4>{{ $profile->full_name }}</h4>   
              <table class="table table-borderless">
                <tr>                     
                  <td><strong>Email: </strong></span>{{ $profile->User->email }}</td>               
                  <td><strong>Telephone:</strong></span> {{$profile->DefaultPhone->phone_number ?? 'None'}}</td>
                </tr>
                <tr>
                  <td><strong>Gender:</strong></span> {{$profile->gender}}</td>            
                  <td><strong>Date of Birth:</strong></span> {{$profile->birthday ?? 'N/A'}}</td>         
                </tr>
                <tr>
                  <td colspan="2"><strong>Address:</strong></span> {{$profile->Address->full_address}}</td>            
                </tr>
                
              </table>
            </div>
            
          </div>
          <hr>
          <h5>Uploaded documents</h5>
          <div class="row">
            @foreach ($profile->requireddocuments as $document)
              <div class="col-md-4">
                <div class="card">
                  <img src="{{ asset($document->front) }}" alt="" class="w-100" height="150px">
                  <div class="card-body">
                  <a class="btn btn-success btn-sm" href="#view{{ $document->id }}" data-toggle="modal" data-target="#view{{ $document->id }}">View Details</a>
                  </div>
                </div>
              </div> 
              @include('requireddocuments._details')
              @include('requireddocuments._approve')
              @include('requireddocuments.reject')
            @endforeach
          </div>
          <hr>
          @if (Auth::user()->Profile->role_id == 1 && $profile->status <> 'Approved')
          <div class="pull-right">
            <form action="{{ route('profiles.process') }}" method="post"
              onsubmit="return confirm('Are you sure you want to approve this profile?');">
              <input type="hidden" name="profile_id" value="{{$profile->id}}" />
              {{ csrf_field() }}
              <button type="submit" name="status" class="btn btn-lg btn-success px-5" value="Approved"> Approve</button>
            </form>
          </div> 
          @endif
         
          
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
