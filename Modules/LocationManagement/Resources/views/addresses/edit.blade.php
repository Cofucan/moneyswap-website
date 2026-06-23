@extends('layouts.admin')
@section('page_title', 'Edit Address')
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

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('addresses/manage')}}" class="s-text16">
            Addresses
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
           Edit address
        </span>
    </div>

<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>



        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Edit address</h4>
          <form method="POST" action="{{ route('addresses.update', $address->id) }}" id="UpdateAddress" enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')

            <div class="form-row">
              <div class="col-md-3 form-group mb-3">
                    <label for="address_no" class="control-label">Ref</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <select class="custom-select w-100 select2" id="address_prefix" name="address_prefix">
                                @foreach($addressPrefix as $address_prefix)
                                        @if($address->address_prefix == $address_prefix)
                                            <option value="{{  $address_prefix }}" selected>{{  $address_prefix }}</option>
                                        @else
                                            <option value="{{  $address_prefix }}">{{  $address_prefix }}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </div>
                        <input type="text" name="address_no" value="{{ $address->address_no }}" class="form-control{{ $errors->has('address_no') ? ' is-invalid' : '' }}" id="address_no" placeholder="123/456" required>
                    </div>
                        @if ($errors->has('address_no'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('address_no') }}</strong>
                                </span>
                        @endif

                </div>

              <div class="col-md-9 mb-3">

                    <label for="street_name" class="control-label">Street</label>
                    <input type="text" name="street_name" value="{{ $address->street_name }}" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : '' }}" id="street_name" placeholder="">
                            @if ($errors->has('street_name'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('street_name') }}</strong>
                            </span>
                            @endif
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6 mb-3 form-group">
                      <label for="city_id"> City</label>
                      <select name="city_id" class="custom-select d-block w-100 select2" id="city" required>
                          @foreach($cities as $key => $city)
                            @if($address->city_id == $key)
                              <option value="{{$key}}" selected> {{$city}}</option>
                              @else
                              <option value="{{$key}}"> {{$city}}</option>
                            @endif
                         
                          @endforeach
                      </select>
                      @if ($errors->has('city_id'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('city_id') }}</strong>
                                  </span>
                      @endif
              </div>

              <div class="col-md-6 mb-3 form-group">
                    <label for="neighbourhood_id"> Neighbourhood</label>
                    <select name="neighbourhood_id" class="custom-select d-block w-100 select2" id="neighbourhood" required>
                      
                    </select>
                  <span id="city_loading"><i class="fa fa-spinner fa-2x fa-spin"></i></span>
              </div>
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
