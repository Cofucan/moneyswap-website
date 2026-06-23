<form action="{{ route('profiles.changephoto') }}" method="POST" enctype="multipart/form-data" >
    {{csrf_field()}}
    <input type="hidden" name="profile_id" value="{{ $client->profile_id }}">
    <div class="input-group mb-3">
        <img src="{{ asset ($client->Profile->avatar) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
        <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
        <div class="input-group-append" id="button-addon4">
        <button type="submit" class="btn btn-sm btn-primary btn-block">
            {{ __('Change') }}
        </button>
        </div>
    </div>
</form>