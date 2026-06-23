
@include('profilemanagement::profiles.form')
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="primary_language">Primary language</label>
            <input id="primary_language" type="text" value="{{ old ('primary_language')}}" class="form-control{{ $errors->has('primary_language') ? ' is-invalid' : '' }}" name="primary_language" >
            @if ($errors->has('primary_language'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('primary_language') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="position_in_family">Position in Family</label>
            <select name="position_in_family" class="custom-select select2" id="position_in_family" required>
                {{ $last = 10 }}
                {{ $first = 1 }}
                @for($i = $first; $i <= $last; $i++)
                <option value="{{$i}}"> {{$i }}</option>
                @endfor
            </select>
            @if ($errors->has('position_in_family'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('position_in_family') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="client_category_id">Category </label>
            <select name="client_category_id" class="custom-select select2" id="clientcategory" required>
                @foreach($clientcategories as $key => $clientcategory)
                <option value="{{$key}}"> {{$clientcategory}}</option>
                @endforeach
            </select>
            @if ($errors->has('client_category_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('client_category_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="country_code">Nationality</label>
            <select name="country_code" class="custom-select select2" id="country_code" required>
                @foreach($countries as $key => $country)
                <option value="{{$key}}"> {{$country}}</option>
                @endforeach
            </select>
            @if ($errors->has('country_code'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('country_code') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="religion_id">Religion </label>
            <select name="religion_id" class="custom-select select2" id="religion" required>
                @foreach($religions as $key => $religion)
                <option value="{{$key}}"> {{$religion}}</option>
                @endforeach
            </select>
            @if ($errors->has('religion_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('religion_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="relationship_id">Relationship with Orphan</label>
            <select name="relationship_id" class="custom-select select2" id="relationship" required>
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
    </div>
</div>


<h6 class="line"> Enrolment Details</h6>
    {{-- <hr> --}}
<div class="form-row">
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="cause_id">How can should help? </label>
            <select name="cause_id" class="custom-select select2" id="cause" required>
                <option value=""> Select Help Category</option>
                @foreach($causes as $key => $cause)
                <option value="{{$key}}"> {{$cause}}</option>
                @endforeach
            </select>
            @if ($errors->has('cause_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('cause_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="program_id">Program </label><span id="program_loading"><i class="fa fa-spinner fa-spin"></i> Loading programs, pls wait!</span>
            <select name="program_id" class="custom-select d-block w-100 select2 {{ $errors->has('program_id') ? ' is-invalid' : '' }}" id="program" required>
            </select>
        </div>
    </div>
</div>
