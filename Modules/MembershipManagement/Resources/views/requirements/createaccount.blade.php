@section('page_title', 'Our')
@extends('layouts.theme')
@push('style')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link href="{{ asset ('css/member.css')}}" rel="stylesheet">
<link href="{{ asset ('css/modal-animate.css') }}" rel="stylesheet">
@endpush


@section('content')

 <section id="page-image">
    <img src="{{ asset('img/member1.jpg')}}">
 </section>


  <!--==========================
      What We Do Section
    ============================-->
    <section id="member">
        <div class="container">
          <div class="row">
            <div class="col-md-12 facility">
                <h3 class="text-center">Create an Account or Login to continue</h3>
                <hr>
                
                <div class="row">
                
                    <div class="col-md-6 ">
                        <div class="box box-body">
                            <h6>Don't Have an account? Create Now!</h6>
                            <hr>
                            <form method="POST" action="{{ route('sections.store') }}" id="CreateSection" enctype="multipart/form-data">
                                {{csrf_field()}}  
                                
                                <div class="form-group">
                                    <label for="contact_name" class="control-label"> Name</label>
                                    <input id="contact_name" type="text" value="{{ old('contact_name')}}" class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}" name="contact_name"  required autofocus>
                                    @if ($errors->has('contact_name'))
                                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('contact_name') }}</strong>
                                                </span>
                                    @endif                  
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label for="contact_email" class="control-label"> Email</label>
                                        <input id="contact_email" type="email" value="{{ old('contact_email')}}" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" name="contact_email"  required autofocus>
                                        @if ($errors->has('contact_email'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                    </span>
                                        @endif                  
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="contact_number" class="control-label"> Telephone</label>
                                        <input id="contact_number" type="email" value="{{ old('contact_number')}}" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number"  required autofocus>
                                        @if ($errors->has('contact_number'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                                    </span>
                                        @endif                  
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label for="password" class="control-label"> Password</label>
                                        <input id="password" type="password" value="{{ old('password')}}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  required autofocus>
                                        @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                        @endif            
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="password" class="control-label"> Confirm Password</label>
                                        <input id="password" type="password" value="{{ old('password')}}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  required autofocus>
                                        @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                        @endif                  
                                    </div>
                                </div>
                                <div class="form-group">
                                                    
                                </div>
                
                            
                                <button class="btn btn-success btn-sm btn-block" type="submit">Continue </button>
                                        
                            </form>    
                        </div>       
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <h6>Already have an Account? Login</h6>
                        <hr class="mb-4">
                        <form method="POST" action="{{ route('sections.store') }}" id="CreateSection" enctype="multipart/form-data">
                            {{csrf_field()}}  
                            
                            <div class="form-group">
                                <label for="contact_email" class="control-label"> Email</label>
                                <input id="contact_email" type="email" value="{{ old('contact_email')}}" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" name="contact_email"  required autofocus>
                                @if ($errors->has('contact_email'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('contact_email') }}</strong>
                                            </span>
                                @endif                  
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label"> Password</label>
                                <input id="password" type="password" value="{{ old('password')}}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  required autofocus>
                                @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                @endif                  
                            </div>
            
                            
                            <button class="btn btn-sm btn-success btn-block" type="submit">Continue </button>
                                    
                        </form>           
                    </div>

                </div>        
            
        </div>
    </section>

    
    

    
  @endsection
  @push('scripts')
<script>
    CKEDITOR.replace("section_overview",
        {
            height: 120        
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript"> 
 $(document).ready(function()
 {
   $('#sectionable_type').select2();
   $('#sectionable').select2();
  }
  );
  $('#sectionable_type').on('change',function()
{
  var sectionable_type = $(this).val(); 
  if(sectionable_type){
    $.ajax({
      type:"GET",
      url:"{{url('sections/get-sectionable-list')}}?sectionable_type="+sectionable_type,
      beforeSend: function()
      {
        $('#live_loading').css("visibility", "visible");
      },
      success:function(res){ 
        if(res){ 
          
          $("#sectionable").empty();
          
          $('#live_loading').css("visibility", "hidden");
          
          $.each(res,function(key,value)
          {
            $("#sectionable").append('<option value="'+key+'">'+value+'</option>'); });
          }else
          {
            $("#sectionable").empty(); 
          } 
        } }); 
  }else{
    $("#sectionable").empty(); 
  } 
});
</script>

<script>
  

  function showDescription() {
      document.getElementById("Description").style.display = "block";
  }

  function closeDescription() {
      document.getElementById("Description").style.display = "none";
  }
  
</script>

@endpush