@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
  #cambox{
        position:relative;
        width:500px;
        height: 400px;
        margin: 0 auto;
    }

    #webcam, #live_img_profile_preview, #nocamera {
        background:#eee;
        border:5px solid #999;
        height: 240px;
        margin-left:60px;
        margin:10px 20px;
        position:absolute;
        width: 320px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    #webcam {
        z-index:2000;
    }

    #live_img_profile_preview {
        display:none;
        z-index:5000;
    }

    #nocamera {
        display:none;
        z-index:9900;
    }

    #buttons{
        position:absolute;
        bottom:0;
        right:165px;
        z-index:100;
    }

    #light_webcam {
        background-color:#c00;
        display:none;
        height:500px;
        left:0px;
        position:absolute;
        top:0px;
        width:100%;
        z-index:5000;
    }

    object {
        display:block;
        position:relative;
        z-index:1000;
    }

    #smartsystem{
        background:transparent;
        height:40px;
        margin-left:67px;
        position:absolute;
        top:220px;cursor:pointer;
        z-index:2100;
    }

    .message{
        padding:80px 10px;
    }

    .livecountdown{
        font-size:26px;
        font-weight:bold;
        color:#fff;
        padding-left:153px;
        display:none;
    }

    .click{
        padding-left:145px;
    }

    .close{
        position: absolute;
        right: 0;
        color:#fff;
        top: 0;
        cursor:pointer;width:22px;height:22px;display:block;background:url(picture/web_icon_close.png) top;
    }
    .close:hover{
        position: absolute;
        right: 0;
        color:#fff;
        top: 0;
        cursor:pointer;width:22px;height:22px;display:block;background:url(picture/web_icon_close.png) bottom;
    }
</style>
@endpush

@section('content')
    <div class="container">
    <h2>PHP capture image from webcam using jquery</h2>
<div id="cambox">

<div id="webcam"></div>

<div id="smartsystem">
        <span class="livecountdown">3</span>
        <span class="click"><img alt="take photo" src="picture/camera_icon.png" /></span>
    </div>


<div id="nocamera">

<div class="message">
            Video has not detected so Please any available simple cameras on your Laptop or system. Please so You connect a camera and try again.
        </div>

    </div>

<div id="live_img_profile_preview">
        <img id="live_img_profile_previewImg" alt="live_img_profile_preview Image" height="240" width="320" src="picture/imgloading.gif" />
        <span class="close"></span>
    </div>
</div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
  $("#live_img_profile_preview .close").click(function(){
    $("#buttons .store_wbcam_img").attr('disabled',true);
    $('.livecountdown').hide();
    $('#live_img_profile_preview').hide();
    $('#live_img_profile_previewImg').attr('src',baseurl+'picture/imgloading.gif');
    $('.click').show();
});

var coverUserImg = null;
$("#buttons .store_wbcam_img").click(function(){

    $.post(baseurl+"live_webcam_images_ipload.php",
    { image: coverUserImg},
    function(data){
        window.location = 'live_webcam_images_ipload.php';
    });
});

function webcamTakeImg(){
    $('.click').hide();
    $('.livecountdown').show();
    webcam.capture(3);
}

function webcam_init() {
    var imgpostion = 0, ctx = null, saveCB, image = [];
    var canvas = document.createElement("canvas");
    canvas.setAttribute('width', 320);
    canvas.setAttribute('height', 240);

        if (canvas.toDataURL) {
            ctx = canvas.getContext("2d");

            image = ctx.getImageData(0, 0, 320, 240);

            saveCB = function(data) {

                var col = data.split(";");
                var picture = image;

                for(var i = 0; i > 16) & 0xff;
                    picture.data[imgpostion + 1] = (tmp >> 8) & 0xff;
                    picture.data[imgpostion + 2] = tmp & 0xff;
                    picture.data[imgpostion + 3] = 0xff;
                    imgpostion+= 4;
                }

                if (imgpostion >= 4 * 320 * 240) {
                    ctx.putImageData(picture, 0, 0);
                    $('#live_img_profile_preview').show();
                    $.post(baseurl+"live_webcam_images_ipload.php", {type: "data", image: canvas.toDataURL("image/png")},function(data){
                        $("#buttons .store_wbcam_img").attr('disabled',false);
                        coverUserImg = data;
                        $('#live_img_profile_previewImg').attr('src',''+baseurl+data);
                    });
                    imgpostion = 0;
                }
            };
        }else{

            saveCB = function(data) {
                image.push(data);

                imgpostion+= 4 * 320;

                if (imgpostion >= 4 * 320 * 240) {
                        $('#live_img_profile_preview').show();
                        $.post(baseurl+"live_webcam_images_ipload.php", {type: "pixel", image: image.join('|')},function(data){
                            $("#buttons .store_wbcam_img").attr('disabled',false);
                            coverUserImg = data;
                            $('#live_img_profile_previewImg').attr('src',''+baseurl+data);
                        });
                        imgpostion = 0;
                        image = [];
                }
            }
        }

        $("#webcam").webcam({
                width: 320,
                height: 240,
                mode: "callback",
                swffile: baseurl+"js/webcam/jscam_canvas_only.swf",

                onSave: saveCB,

                onCapture: function () {

                    jQuery("#light_webcam").css("display", "block");
                    jQuery("#light_webcam").fadeOut("fast", function () {
                        jQuery("#light_webcam").css("opacity", 1);
                    });

                    webcam.save();
                },

                onTick: function(remain) {
                    $('.livecountdown').show();

                    if (0 == remain) {
                        $('.livecountdown').hide();
                    } else {
                        jQuery(".livecountdown").text(remain);
                    }
                },

                debug: function (type, string) {
                        if(type == 'error'){
                            $("#nocamera").show();
                        }else{
                            $("#nocamera").hide();
                        }

                },

                onLoad: function() {
                    //var cams = webcam.getCameraList();
                }
        });

}

(function ($) {
    webcam_init();
})(jQuery);

</script>
@endpush
