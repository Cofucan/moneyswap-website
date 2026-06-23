
    <div class="form-row">
        <div class="col-md-6 form-group">
            <label for="role_category_id">Recipient Type</label>
            <select name="role_category_id" class="custom-select d-block w-100 select2" id="rolecategory" required>
                {{-- <option value=""> Select Section</option> --}}
                    @foreach($rolecategories as $key => $rolecategory)
                        @if(old('role_category_id') == $key)
                        <option value="{{$key}}" selected> {{$rolecategory }}</option>
                            @else
                        <option value="{{$key}}">  {{$rolecategory }}</option>
                        @endif
                    @endforeach
            </select>
            @if ($errors->has('role_category_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('role_category_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-6 form-group">
            <label for="profiles"> Recipient Stream </label>
            <select name="profiles[]" class="custom-select d-block w-100 select2" id="profiles" data-live-search="true">
            </select>
            <span id="live_loading"><i class="fa fa-spinner  fa-spin"></i></span>
            @if ($errors->has('profiles '))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('profiles ') }}</strong>
            </span>
            @endif
        </div>

        <div class="col-md-12 form-group">
            <label for="profiles"> To </label>
            <select name="profiles[]" class="custom-select d-block w-100 select2" multiple="multiple" id="profiles" data-live-search="true">
            </select>
            <span id="live_loading"><i class="fa fa-spinner  fa-spin"></i></span>
            @if ($errors->has('profiles '))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('profiles ') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="headline"> Subject</label>
        <input type="text" name="headline" value="{{old('headline')}}" class="form-control {{ $errors->has('headline') ? ' is-invalid' : '' }}"  id="headline"/>
        @if ($errors->has('headline'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('headline') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group ">
        <label for="announcement_body">Announcement Body</label>
        <textarea name="announcement_body" class="form-control {{ $errors->has('announcement_body') ? ' is-invalid' : '' }}" rows="5">
            {{old('announcement_body')}}
        </textarea>
        @if ($errors->has('announcement_body'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('announcement_body') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-row mb-3">
        <div class="col-md-12">
            <label for="action_button"> Action Button</label>
        </div>
        <div class="col-md-6 input-group">
            <div class="input-group-append">
                <div class="input-group-text">Text</div>
            </div>
            <input type="text" name="action_text" value="{{ old ('action_text')}}" class="form-control{{ $errors->has('action_text') ? ' is-invalid' : '' }}"/>
            @if ($errors->has('action_text'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('action_text') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-6 input-group">
            <div class="input-group-append">
                <div class="input-group-text">Link</div>
            </div>
            <input type="text" name="action_url" value="{{ old ('action_url')}}" class="form-control{{ $errors->has('action_url') ? ' is-invalid' : '' }}"/>
            @if ($errors->has('action_url'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('action_url') }}</strong>
                </span>
            @endif
        </div>
    </div>




    {{-- <div class="form-row">
        <div class="col-md-6 form-group">
            <label for="status">Action</label>
            <select class="custom-select{{ $errors->has('status') ? ' is-invalid' : '' }} d-block w-100 select2"  name="status" id="status" required>

            @foreach($statuses as $key => $status)
            @if(old('status') == $key)
            <option value="{{$key}}" selected> {{$status}}</option>
                @else
                <option value="{{$key}}"> {{$status}}</option>
                @endif
            @endforeach
            </select>
            @if ($errors->has('status'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>

    </div> --}}

