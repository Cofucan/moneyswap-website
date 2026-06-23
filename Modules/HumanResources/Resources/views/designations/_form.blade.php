<div class="form-group">
    <label for="job_role"> Designation</label>
    <input type="text" name="job_role" value="{{old('job_role')}}" class="form-control" placeholder="Enter job_role title"  id="job_role" />
    @if ($errors->has('job_role'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('job_role') }}</strong>
        </span>
    @endif
</div>

<div class="form-row">
     <div class="col-md-6 form-group">
        <label for="department_id">Departments</label>
        <select class="custom-select d-block w-100 select2{{ $errors->has('department_id') ? ' is-invalid' : '' }}" name="department_id" id="department">
            @foreach($departments as $key => $department)
                @if($key == old('department_id') )
                <option value="{{$key}}" selected> {{$department}}</option>
                @else
                <option value="{{$key}}"> {{$department }}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('department_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('department_id') }}</strong>
                </span>
        @endif
    </div>
    <div class="col-md-6 form-group">
        <label for="role_id">Portal Role</label>
        <select class="custom-select d-block w-100 select2{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="role">
          
        </select>
        @if ($errors->has('role_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('role_id') }}</strong>
                </span>
        @endif
        <span id="role_loading"><i class="fa fa-spinner fa-spin"></i></span>
    </div>    
</div>

<div class="form-row">
   <div class="col-md-6 form-group">
       <label for="parent_id">Report to</label>
       <select class="custom-select d-block w-100 select2{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" name="parent_id" id="parent">
           @foreach($designations as $key => $designation)
               @if(old('parent_id') == $key)
               <option value="{{$key}}" selected> {{$designation}}</option>
               @else
               <option value="{{$key}}"> {{$designation}}</option>
               @endif
           @endforeach
       </select>
       @if ($errors->has('parent_id'))
               <span class="invalid-feedback">
               <strong>{{ $errors->first('parent_id') }}</strong>
               </span>
       @endif
   </div>   
   
   
   {{-- <div class="col-md-6 form-group">
        <label for="parent_id">Division</label>
        <select class="custom-select d-block w-100 select2{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" id="division_id">
            @foreach($divisions as $key => $division)
                @if(old('division_id') == $key)
                <option value="{{$key}}" selected> {{$division}}</option>
                @else
                <option value="{{$key}}"> {{$division}}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('division_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('division_id') }}</strong>
                </span>
        @endif
    </div>  --}}
</div>

<div class="form-group ">
    <label for="job_description">Job Description</label>
    <textarea name="job_description" class="form-control" required>
        {!! old('job_description') !!}
    </textarea>
    @if ($errors->has('job_description'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('job_description') }}</strong>
        </span>
    @endif
</div>

<div class="form-group ">
    <label for="responsibilities"> Responsibilities </label>
    <textarea name="responsibilities" class="form-control">
        {!! old('responsibilities') !!}
    </textarea>
    @if ($errors->has('responsibilities'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('responsibilities') }}</strong>
        </span>
    @endif
</div>