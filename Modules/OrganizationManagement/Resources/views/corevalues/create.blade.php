@extends('layouts.admin')
@section('page_title', 'Add Core Value')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css')}}">
<style>
        #city_loading{
        visibility:hidden;
        }
        #neighbourhood_loading{
        visibility:hidden;
        }
</style>
@endpush
@section('content')

        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <a href="{{ url ('corevalues/manage')}}" class="s-text16">
                Core Values
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Add Core Value
            </span>
        </div>

<div class="row">
  <div class="col-md-3 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            
          </h4>



        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Core Value</h4>
          <form method="POST" action="{{ route('corevalues.store') }}" id="CreateCoreValue" enctype="multipart/form-data">
          {{csrf_field()}}
            <input type="hidden" name="school_id" value="7">
            <div class="form-group">
              <label for="value_title">Title</label>
              <input type="text" name="value_title" value="{{old('value_title')}}" class="form-control{{ $errors->has('value_title') ? ' is-invalid' : ''}}">
              @if ($errors->has('value_title'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('value_title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="display_image"> Display Image</label>
                <input type="file" name="display_image" value="{{ old ('display_image')}}" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}"/>
                @if ($errors->has('display_image'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('display_image') }}</strong>
                    </span>
                @endif
              </div>
              <div class="col-md-6 form-group">
                <label for="display_order"> Display Order</label>
                <input type="number" name="display_order" value="{{ old ('display_order')}}" class="form-control{{ $errors->has('display_order') ? ' is-invalid' : '' }}"/>
                @if ($errors->has('display_order'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('display_order') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          
            <div class="form-group ">
              <label for="summary">Summary</label>
              <textarea name="summary" class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}">
                  {!! old('summary') !!}
              </textarea>
              @if ($errors->has('summary'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('summary') }}</strong>
                  </span>
              @endif
            </div>
       

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Save </button>
            <button class="btn btn-primary" type="reset">Cancel</button>

          </form>
          </div>
</div>

@endsection
@push('scripts')
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function(){
      $('.select2').select2();
    CKEDITOR.replace( 'content_body' );

  });
</script>
    <script type="text/javascript">
        $('#city').on('change',function(){
            var city = $(this).val();
            if(city){
            $.ajax({
            type:"GET",
            url:"{{url('cities/get-neighbourhood-list')}}?city="+city,
            beforeSend: function()
            {
            $('#city_loading').css("visibility", "visible");
            },
            success:function(res){
            if(res){
                $("#neighbourhood").empty();

                $('#city_loading').css("visibility", "hidden");

                $.each(res,function(key,value)
                {
                $("#neighbourhood").append('<option value="'+key+'">'+value+'</option>'); });
                }else
                {
                $("#neighbourhood").empty();
                }
            } });
            }else{
            $("#neighbourhood").empty();
            }
        });
    </script>
@endpush
