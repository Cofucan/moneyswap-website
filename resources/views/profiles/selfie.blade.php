@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }

 #my_camera{
     width: 320px;
     height: 240px;
     border: 1px solid black;
}
</style>
@endpush

@section('content')
    <div class="container">
        <div class="row ">

            <div class="col-md-8">
            <h4>Confirm your the one using your device</h4>
            <p>Your privacy is paramount to us, please kindly upload your picture to ensure no one else is using your device to create this account.</p>
                <div class="card">
                    <div class="card-body form-card">
                    <form action="{{ route('profiles.changephoto') }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="profile_id" value="{{ Auth::user()->profile_id }}">
                            {{-- <input type="hidden" name="upload_type" value="selfie"> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset ( 'img/icons/avatar.png' )}}" alt="Profile Picture" class="avatar img-thumbnail" id="picture">
                                    <input type="file"  name="avatar" class="form-control center-block id-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
                                </div>
                            </div>

                            <hr>
                                                        
                            <button type="submit" class="btn btn-primary">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<!-- Configure a few settings and attach camera -->
<script>
    $(document).ready(function () {
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#picture').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".id-upload").on('change', function(){
            readURL(this);
        });
    });
</script>
@endpush
