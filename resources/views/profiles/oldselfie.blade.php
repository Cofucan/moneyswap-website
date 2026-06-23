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
            <p>Your privacy is paramount to us, please take a clear selfie of your self to ensure no one else is using your device to create this account.</p>
                <div class="card">
                    <div class="card-body form-card">
                    <form action="{{ route('profiles.changephoto') }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="profile_id" value="{{ Auth::user()->profile_id }}">
                            <input type="hidden" name="upload_type" value="selfie">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="my_camera"></div>
                                    <br/>
                                    <input type=button class="btn btn-sm btn-primary" value="Take Snapshot" onClick="take_snapshot()">
                                    <input type="hidden"  name="avatar" class="image-tag">
                                </div>
                                <div class="col-md-6">
                                    <div id="results">Your captured image will appear here...</div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <br/>
                                    <button type="submit" class="btn btn-success mt-2">Save </button>
                                </div>
                            </div>
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
<script language="JavaScript">
    Webcam.set({
        width: 320,
	    height: 240,
	    dest_width: 640,
	    dest_height: 480,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach( '#my_camera' );
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }

    // preload shutter audio clip
 var shutter = new Audio();
 shutter.autoplay = true;
 shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

</script>
@endpush
