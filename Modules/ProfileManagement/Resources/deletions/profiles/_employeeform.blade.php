<div class="form-row">
    <div class="col-md-4 mb-3">
        <label for="last_name" class="control-label"> Name</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <select id="salutation" name="salutation" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a salutation ...">
                <option value="Mr" selected> Mr </option>
                <option value="Mrs"> Mrs </option>
                <option value="Miss">Miss </option>
            </select>
          </div>
          <input type="text" name="last_name" value="{{$employee->Profile->last_name }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" placeholder="Last Name"required>
        </div>
        @if ($errors->has('last_name'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('last_name') }}</strong>
                </span>
        @endif
    </div>

    <div class="col-md-4 mb-3">
      <label for="first_name" class="control-label">.</label>
      <input type="text" name="first_name" value="{{$employee->Profile->first_name }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="First Name">

        @if ($errors->has('first_name'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('first_name') }}</strong>
          </span>
        @endif
    </div>

    <div class="col-md-4 mb-3">
      <label for="middle_name" class="control-label">.</label>
      <input type="text" name="middle_name" value="{{$employee->Profile->middle_name}}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name" placeholder="Other Names">

        @if ($errors->has('middle_name'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('middle_name') }}</strong>
          </span>
        @endif
    </div>
</div>

    <div class="form-row">

        <div class="col-md-6  form-group">
          <label class="control-label" for="birthday">Date of Birth</label>
          <div class="input-group">
              <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
              <input type="date" name="birthday" value="{{$employee->Profile->birthday}}" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"/>

          </div>
          @if ($errors->has('birthday'))
              <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('birthday') }}</strong>
              </span>
          @endif
        </div>

      <div class="col-md-6 mb-3 form-group">
          <label for="gender" class="control-label"> Gender </label><br>
          <div class="custom-control custom-radio custom-control-inline">
              <input id="male" name="gender" type="radio" value="Male" class="custom-control-input" required>
              <label class="custom-control-label" for="male">Male</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
              <input id="Female" name="gender" type="radio" value="Female" class="custom-control-input" required>
              <label class="custom-control-label" for="Female">Female</label>
          </div>
          @if ($errors->has('gender'))
              <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('gender') }}</strong>
              </span>
          @endif
      </div>

    </div>

    <div class="form-group mb-3">
        <label for="bio">About</label>
        <textarea name="bio" class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" id="textarea" placeholder=""> {!!$employee->profile->bio!!}</textarea>
        @if ($errors->has('bio'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('bio') }}</strong>
            </span>
        @endif
    </div>

    


