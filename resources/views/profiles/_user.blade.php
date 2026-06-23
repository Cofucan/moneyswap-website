<div class="form-group has-feedback">
  <label for="profile_id">Profile<span class="text-muted"> *</span></label>
    <select name="profile_id" class="custom-select select2 d-block w-100" id="profile_id" required>
      @foreach($profiles as $key => $profile)
      {{-- @if( $user->Profiles() == $key) --}}
      {{-- <option value="{{$key}}" selected> {{$profile}}</option>
          @else --}}
          <option value="{{$key}}"> {{$profile}}</option>
          {{-- @endif --}}
      @endforeach
    </select>
                          
  @if ($errors->has('profile_id'))
    <span class="invalid-feedback">
    <strong>{{ $errors->first('profile_id') }}</strong>
    </span>
  @endif
</div>

<div class="form-group has-feedback">
  <label for="role_id">Role<span class="text-muted"> *</span></label>
    <select name="role_id" class="custom-select select2 d-block w-100" id="role_id" required>
      @foreach($roles as $key => $role)
      @if( $user->role_id == $key)
      <option value="{{$key}}" selected> {{$role}}</option>
          @else
          <option value="{{$key}}"> {{$role}}</option>
          @endif
      @endforeach
    </select>
                          
  @if ($errors->has('role_id'))
    <span class="invalid-feedback">
    <strong>{{ $errors->first('role_id') }}</strong>
    </span>
  @endif
</div>
<div class="custom-control custom-checkbox custom-control-inline mb-4">
    <input id="profile" name="default_profile" type="checkbox" value="1" class="custom-control-input">
    <label class="custom-control-label" for="profile">Is Default</label>
</div>
