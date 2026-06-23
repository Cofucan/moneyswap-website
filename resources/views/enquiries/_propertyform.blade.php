<div class="mb-3 form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-user-o"></i></div>
        </div>
        <input id="full-name" type="text" class="form-control{{ $errors->has('full-name') ? ' is-invalid' : '' }}" name="full-name" placeholder="Full Name" required autofocus>
    </div>
    

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div> 
<div class="mb-3 form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
        </div>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="E-mail Address" required autofocus>
    </div>
    

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div> 

<div class="mb-3 form-group">
  <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
        </div>
        <input type="text" class="form-control" id="location" placeholder="Location">
    </div>
  

  @if ($errors->has('property_type'))
      <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('property_type') }}</strong>
      </span>
  @endif
</div> 

<div class="form-row">
  <div class="col-md-6 mb-3 form-group">
    <select name="property_type" class="custom-select d-block w-100" id="property_type" required>
        <option value="property_type">Property Type</option>  
        <option>Land</option> 
        <option>Two Bedroom Duplex</option> 
        <option>Building</option>      
    </select>
    

    @if ($errors->has('property_type'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('property_type') }}</strong>
        </span>
    @endif
  </div> 
  
  <div class="col-md-6 mb-3 form-group">
    <select name="list_type" class="custom-select d-block w-100" id="list_type" required>
        <option value="property_type">List Type</option>  
        <option>Buy</option>    
        <option>Rent</option>  
    </select>
    

    @if ($errors->has('property_type'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('property_type') }}</strong>
        </span>
    @endif
  </div> 
</div>
                 
<div class="mb-3 form-group">
  <textarea class="form-control" name="remarks" id="remarks" rows="2" placeholder="Additional Information"></textarea>
  @if ($errors->has('remarks'))
    <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('remarks') }}</strong>
    </span>
  @endif
</div> 