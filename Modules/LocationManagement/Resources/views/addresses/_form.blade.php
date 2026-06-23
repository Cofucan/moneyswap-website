@push('styles')
<!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('css/select2.css')}}">
    <style>
            #state_loading{
            visibility:hidden;
            }
            #city_loading{
            visibility:hidden;
            }
            #neighbourhood_loading{
            visibility:hidden;
            }
    </style>
@endpush

<div class="form-row">
            <div class="col-md-6 mb-3 form-group">
                      <label for="state_id"> State</label>
                      <select name="state_id" class="custom-select d-block w-100 select2 {{ $errors->has('state_id') ? ' is-invalid' : '' }}" id="state">
                          <option>Choose State </option>
                          @foreach($states as $key => $state)
                          <option value="{{$key}}"> {{$state}}</option>
                          @endforeach
                      </select>
                      @if ($errors->has('state_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('state_id') }}</strong>
                            </span>
                      @endif
            </div>
            <div class="col-md-6 mb-3 form-group">
                      <label for="city_id"> City</label>
                      <select name="city_id" class="custom-select d-block w-100 select2 {{ $errors->has('city_id') ? ' is-invalid' : '' }}" id="city">
                      </select>
                  <span id="city_loading"><i class="fa fa-spinner fa-2x fa-spin"></i></span>
                      @if ($errors->has('city_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('city_id') }}</strong>
                            </span>
                      @endif
            </div>
            </div>

            <div class="form-row">
              <div class="col-md-3 form-group mb-3">
                    <label for="building_no" class="control-label">Building Reference</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <select class="custom-select w-100 select2" id="address_prefix" name="address_prefix">
                                @foreach($addressPrefix as $address_prefix)
                                        @if(old('address_prefix') == $address_prefix)
                                            <option value="{{  $address_prefix }}" selected>{{  $address_prefix }}</option>
                                        @else
                                            <option value="{{  $address_prefix }}">{{  $address_prefix }}</option>
                                        @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="text" name="building_no" value="{{old ('building_no') }}" class="form-control{{ $errors->has('building_no') ? ' is-invalid' : '' }}" id="building_no" placeholder="123/456" required>
                    </div>
                        @if ($errors->has('building_no'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('building_no') }}</strong>
                                </span>
                        @endif

                </div>

              <div class="col-md-9 mb-3">
                    <label for="street_name" class="control-label">Street</label>
                    <input type="text" name="street_name" value="{{old ('street_name') }}" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : '' }}" id="street_name" placeholder="" >
                    @if ($errors->has('street_name'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('street_name') }}</strong>
                    </span>
                    @endif
              </div>
            </div>

            <div class="form-row">
               <div class="col-md-12 mb-3">
                    <label for="neighbourhood" class="control-label"> Neighbourhood</label>
                    <input type="text" name="neighbourhood_name" value="{{  old('neighbourhood_name') }}" class="form-control{{ $errors->has('neighbourhood_name') ? ' is-invalid' : '' }}" placeholder="Enter neighbourhood"  id="neighbourhood_name"/>
              </div>
            </div>




 @push('scripts')
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function(){
      $('.select2').select2();
  });
</script>
    <script type="text/javascript">
        $('#state').on('change',function(){
            var state = $(this).val();
            if(state){
            $.ajax({
            type:"GET",
            url:"{{url('states/get-city-list')}}?state="+state,
            beforeSend: function()
            {
            $('#city_loading').css("visibility", "visible");
            },
            success:function(res){
            if(res){
                $("#city").empty();
                $('#city_loading').css("visibility", "hidden");
                $.each(res,function(key,value)
                {
                $("#city").append('<option value="'+key+'">'+value+'</option>'); });
                }else
                {
                $("#city").empty();
                }
            } });
            }else{
            $("#city").empty();
            }
        });
    </script>
@endpush
