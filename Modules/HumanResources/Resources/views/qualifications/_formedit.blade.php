<div class="form-group">
        <label for="acronym"> Qualification</label>
        <input type="text" name="acronym" value="{{$qualification->acronym}}" class="form-control" placeholder=" e.g B.SC"  id="acronym" />
        @if ($errors->has('acronym'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('acronym') }}</strong>
            </span>
        @endif
    </div>
    
    <div class="form-group">
        <label for="label"> Qualification Title </label>
        <input type="text" name="label" value="{{$qualification->label}}" class="form-control" placeholder="Enter Qualification Title"  id="label" />
        @if ($errors->has('label'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('label') }}</strong>
            </span>
        @endif
    </div>
    
    {{-- <div class="form-group">
        <label for="program_id">Section</label>
        <select class="custom-select d-block w-100 select2{{ $errors->has('program_id') ? ' is-invalid' : '' }}" name="program_id">
            @foreach($sections as $key => $program)
                @if($qualification->program_id == $key)
                <option value="{{$key}}" selected> {{$program}}</option>
                @else
                <option value="{{$key}}"> {{$program}}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('program_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('program_id') }}</strong>
                </span>
        @endif
    </div> --}}
    