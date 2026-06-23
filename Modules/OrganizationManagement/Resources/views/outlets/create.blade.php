@extends('layouts.admin')
@section('page_title', 'Add Outlet')
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

            <a href="{{ url ('outlets/manage')}}" class="s-text16">
                Outlets
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Add new Outlet
            </span>
        </div>

<div class="row">
  <div class="col-md-3 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            
          </h4>



        </div>
        <div class="col-md-9 order-md-1">
          <h4 class="mb-3">Add Outlet</h4>
          <form method="POST" action="{{ route('outlets.store') }}" id="CreateOutlet">
          {{csrf_field()}}
          @if(old('organization_id', request('organization_id')))
            <input type="hidden" name="organization_id" value="{{ old('organization_id', request('organization_id')) }}">
          @endif

          <div class="form-group mb-3">
            <label for="outlet_label">Outlet Name</label>
            <input type="text" name="outlet_label" value="{{old('outlet_label') }}" class="form-control{{ $errors->has('outlet_label') ? ' is-invalid' : '' }}" id="outlet_label" placeholder="enter campus name">
            @if ($errors->has('outlet_label'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('outlet_label') }}</strong>
                      </span>
                    @endif
          </div>

          <div class="form-row">
            <div class="col-md-6 mb-3 form-group">
                <label for="outlet_type">Outlet Type</label>
                <select name="outlet_type" class="custom-select d-block w-100 select2" id="outlet_type" required>
                    <option>Choose Type </option>
                    @foreach($outletTypes as $key => $outletType)
                    <option value="{{$key}}"> {{$outletType}}</option>
                    @endforeach
                </select>
                @if ($errors->has('outlet_type'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('outlet_type') }}</strong>
                          </span>
                        @endif
            </div>

            <div class="col-md-6 mb-3 form-group">
                <label for="outlet_code">Outlet Code</label>
                <input type="text" name="outlet_code" value="{{old('outlet_code') }}" class="form-control{{ $errors->has('outlet_code') ? ' is-invalid' : '' }}" id="outlet_code" placeholder="Outlet Code">
                @if ($errors->has('outlet_code'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('outlet_code') }}</strong>
                          </span>
                        @endif
            </div>
          </div>

          @include('locationmanagement::addresses._form')

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
