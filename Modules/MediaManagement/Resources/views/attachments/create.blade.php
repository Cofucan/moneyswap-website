<html lang="en">
<head>
  <title>Laravel Multiple File Upload Example</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
        @endif

    <h3 class="jumbotron"> Question</h3>
<form method="post" action="{{url('questions')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="form-group mb-3">
    <label for="question_text" class="control-label">Question</label>
    <input type="text" class="form-control{{ $errors->has('question_text') ? ' is-invalid' : '' }} pull-right" name="question_text"  value="{{old ('question_text')}}"/>
    @if ($errors->has('question_text'))
      <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('question_text') }}</strong>
      </span>
    @endif
  </div>

    <div class="form-row mt-5">
      <div class="col-md-6 form-group">
        <label class="control-label" for="allocated_time">Allocated Time</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            <input type="text" class="form-control{{ $errors->has('allocated_time') ? ' is-invalid' : '' }} pull-right" name="allocated_time"  value="{{old ('allocated_time')}}">
        </div>

        @if ($errors->has('allocated_time'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('allocated_time') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group col-md-6">
        <label for="points" class="control-label">Alloted Mark</label>
        <input type="number" class="form-control{{ $errors->has('points') ? ' is-invalid' : '' }} pull-right" name="points"  value="{{old ('points')}}"/>
        @if ($errors->has('points'))
          <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('points') }}</strong>
          </span>
        @endif
      </div>
    </div>

                
    <div class="form-group mb-3">
        <label for="instruction">Instruction/ Questions  </label>
        <textarea name="instruction" id="instruction" class="form-control" cols="3" rows="3">
          {!! old('instruction') !!}
        </textarea>
        @if ($errors->has('instruction'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('instruction') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
      <label for="attachment" class="control-label">Attach File</label>
      <input type="file" class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }} pull-right" name="attachment"  value="{{old ('attachment')}}"/>
      @if ($errors->has('attachment'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('attachment') }}</strong>
        </span>
      @endif
    </div>
    
    <div class="form-group mb-3">
      <label for="options" class="control-label">Options</label>
            <div class="input-group control-stream increment" >
              <input type="text" name="options[]" class="form-control">
              <div class="input-group-btn"> 
                <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
              </div>
            </div>
            <div class="clone hide">
              <div class="control-stream input-group" style="margin-top:10px">
                <input type="text" name="options[]" class="form-control">
                <div class="input-group-btn"> 
                  <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                </div>
              </div>
            </div>
    </div>
        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

  </form>        
  </div>


<script type="text/javascript">


    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-stream").remove();
      });

    });

</script>
</body>
</html>