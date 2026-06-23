{{--  <div class="form-row">
    <div class="col-md-6 col-sm-6 mb-3 form-group">
        <label class="control-label" for="surname">Surname</label>
        <input id="surname" type="text" value="{{ old ('surname')}}" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" required>
        @if ($errors->has('surname'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('surname') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6 col-sm-6 mb-3 form-group">
        <label class="control-label" for="other_names">Other Names</label>
        <input id="other_names" type="text" class="form-control{{ $errors->has('other_names') ? ' is-invalid' : '' }}" name="other_names" value="{{ old ('other_names')}}" required>
        @if ($errors->has('other_names'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('other_names') }}</strong>
            </span>
        @endif
    </div>
</div>  --}}

<div class="form-row">
    <div class="col-md-6 mb-3 form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
            </div>
            <input id="email" type="email" value="{{ old(Auth::user()->Profile->DefaultEmail->contact_value) }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{Auth::user()->Profile->DefaultEmail->contact_value}}" name="email"  required>
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6 mb-3 form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-phone"></i></div>
            </div>
            <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" placeholder="{{Auth::user()->Profile->DefaultPhone->contact_value}}" value="{{ old(Auth::user()->Profile->DefaultPhone->contact_value) }}" required>
        </div>
        @if ($errors->has('telephone'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('telephone') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="mb-3 form-group">
    <label for="relationship_id"> Relationship</label>
    <select name="relationship_id" class="custom-select d-block w-100 select2 {{ $errors->has('relationship_id') ? ' is-invalid' : '' }}" id="relationship" required>
        <option value="">Relationship with Candidate </option>
        @foreach($relationships as $key => $relationship)
        <option value="{{$key}}"> {{$relationship}}</option>
        @endforeach
    </select>
    @if ($errors->has('relationship_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('relationship_id') }}</strong>
                </span>
    @endif
</div>
