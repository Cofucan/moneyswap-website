<div class="form-group">
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fa fa-user"></i></div>
      </div>
      <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Full Name" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-envelope"></i></div>
        </div>
        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email Address" required>
      </div>
      @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
    </div>
    <div class="form-group col-md-6">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-phone"></i></div>
        </div>
        <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Mobile Number" required>
      </div>
        @if ($errors->has('telephone'))
          <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('telephone') }}</strong>
          </span>
        @endif
    </div>
  </div>

      <div class="mb-3 form-group">
        <textarea class="form-control" name="enquiry_body" id="enquiry_body" rows="2" placeholder=" Information Required"></textarea>
        @if ($errors->has('enquiry_body'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('enquiry_body') }}</strong>
        </span>
        @endif
      </div> 