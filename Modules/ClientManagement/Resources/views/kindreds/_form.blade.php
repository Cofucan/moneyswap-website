
@include('profilemanagement::profiles.basicform')

    <div class="col-md-12 col-sm-12">
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



<span class="span">Availability</span>
<hr>
<div class="form-row mb-2">
    <div class="col-md-12 mb-3 form-group">
        <div class="custom-control custom-radio custom-control-inline">
            <input id="alive" name="living" type="radio" value="Alive" class="custom-control-input" required>
            <label class="custom-control-label" for="alive">Is Alive </label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
                <input id="dead" name="living" type="radio" value="Dead" class="custom-control-input" required>
                <label class="custom-control-label" for="dead">Not Alive </label>
        </div>
    </div>
    <div class="col-md-12">
        <div id="showLiving" class="lifeDiv">
            <div class="form-group">
                <label class="control-label" for="occupation">Occupation</label>
                <input id="occupation" type="text" value="{{ old ('occupation')}}" class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" name="occupation" >
                @if ($errors->has('occupation'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('occupation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div id="showDead" class="lifeDiv">
            <div class="form-group mb-3">
                <label for="expired_at">Died At</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    <input type="date" class="form-control{{ $errors->has('expired_at') ? ' is-invalid' : '' }} pull-right" name="expired_at"  value="{{ old('expired_at') }}">
                    </div>
                    @if ($errors->has('expired_at'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('expired_at') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group mb-3">
                <label for="cause_of_death">Cause Of Death</label>
                <textarea name="cause_of_death" class="form-control{{ $errors->has('cause_of_death') ? ' is-invalid' : '' }}" id="cause_of_death" placeholder="cause of death"> </textarea>
                @if ($errors->has('cause_of_death'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cause_of_death') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>


