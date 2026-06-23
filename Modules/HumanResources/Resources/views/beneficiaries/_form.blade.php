{{-- <p class="mt-4"><b> Contact Details  </b></p> --}}
<div class="form-row">                                
    <div class="col-md-6 mb-3">
        {{-- <div class="form-group"> --}}
            <label class="form-control-label title">Personal Details</label>
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required placeholder="first name">

            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        {{-- </div> --}}
    </div>
    <div class="col-md-6 mb-4">
        {{-- <div class="form-group"> --}}
            <label class="form-control-label title d-none d-lg-block">.</label>
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required placeholder="last name">

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        {{-- </div> --}}
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-3"> 
        {{-- <div class="form-group"> --}}
                                  
        {{-- <label class="form-control-label title">Telephone</label> --}}
        <div class="input-group">       
            <div class="input-group-append">
                <select id="country_id" name="country_id" class="select2 w-100 custom-select" data-live-search="true" title="Please select a country_id ...">
                    @foreach($telcodes as $key => $telcode)
                    <option value="{{$key}}"> (+{{$telcode}})</option>
                    @endforeach
                </select>
            </div>                                 
            <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required placeholder="telephone">
        </div>
        @error('telephone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror   
    {{-- </div>     --}}
    </div>
    <div class="col-md-6">
        {{-- <label class="form-control-label title">Email</label> --}}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-envelope"></i></div>
            </div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="email ">
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>


</div>
<h6 class="title mb-3 mt-3">Location</h6>            
@include('locationmanagement::addresses._locality')

<div class="mb-3">
    @if(isset($cause))
    {{-- <input id="cause_id" type="hidden" name="cause_id" value="{{$cause->id}}">
    <h5 class="title"><b><small>I want to support :</small></b> {{ $cause->label}}</h5> --}}
    @else
    <label for="cause_id" class="control-label title"> Request help for? </label>
    <select id="cause" name="cause_id" class="select2 w-100" title="Please select a cause ...">
    <option value=""> Choose Purpose </option>
        @foreach($causes as $key=> $cause)
            <option value="{{ $key}}">  {{ $cause }} </option>
        @endforeach
    </select>
    @endif
    @error('cause_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group ">
    <label for="remarks">Reasons</label>
    <textarea name="remarks" class="form-control" required rows="3">{!! old('remarks') !!}</textarea>
    @if ($errors->has('remarks'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('remarks') }}</strong>
        </span>
    @endif
</div>