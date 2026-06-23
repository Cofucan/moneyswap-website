<form method="POST" action="{{ route('agents.search') }}" id="FindFamily">
    {{csrf_field()}}
    <input type="hidden" name="criteria" value="Phone"/>
    <div class="form-row my-3 px-3">
        <div class="col-md-7">
            <div class="form-group">
                <label for="value">Enter Agent Telephone.  </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-search"></i></div>
                    </div>
                    <input type="number" name="user_input" value="{{old('user_input')}}" class="form-control{{ $errors->has('user_input') ? ' is-invalid' : '' }}" maxlength="5" id="value" required/>
                </div>
                @if ($errors->has('user_input'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('user_input') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-5">
            <button class="btn-block btn-color" name="todo" value="Search"> Search</button>
        </div>
    </div>
</form>
