<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<link rel="stylesheet" href="{{ url('public/cssjs/bootstrap.min.css') }}" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
.thumb{
    margin: 10px 5px 0 0;
    width: 300px;
} 
</style>
<body>
<article class="bg-secondary mb-3">  
<div class="card-body text-center">
<h4 class="text-white">Laravel Multiple Image Upload Tutorial With Live Preview</h4>
</div>
</article>
<div class="container">  
    @if ($message = Session::get('success'))
 
    <div class="alert alert-success alert-block">
 
        <button type="button" class="close" data-dismiss="alert">×</button>
 
            <strong>{{ $message }}</strong>
 
    </div>
    <br>
    @endif
<form id="file-upload-form" class="uploader" action="{{url('savemultiple')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
@csrf
<input type="file" id="file-input" name="image" multiple />
<span class="text-danger">{{ $errors->first('image') }}</span>
<div id="thumb-output"></div>
<br>
<button type="submit" class="btn btn-success">Submit</button>
</form>
</div>
</body>
<script>
 
    $(document).ready(function(){
     $('#file-input').on('change', function(){ //on file input change
        if (window.File &amp;&amp; window.FileReader &amp;&amp; window.FileList &amp;&amp; window.Blob) //check File API supported browser
        {
             
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                        $('#thumb-output').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
    </script>
</html>