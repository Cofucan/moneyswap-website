

{{-- organization modal begins--}}
<div class="modal fade" id="edit-designation{{ $designation->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Update Designation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('designations.update', $designation->id) }}" method="POST"  id="UpdateDepartment">
                    {{csrf_field()}}
                    @method('PUT')

                    <div class="form-group">
                        <strong>Login Role: </strong> {{ $designation->Role->label  }}
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="job_role"> Designation</label>
                            <input type="text" name="job_role" value="{{$designation->job_role}}" class="form-control" placeholder="Enter designation title"  id="job_role" />
                            @if ($errors->has('job_role'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('job_role') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="parent_id">Report to</label>
                            <select class="custom-select d-block w-100 select2{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" name="parent_id" id="parent">
                                @foreach($parents as $key => $parent)
                                    @if($designation->parent_id==  $key )
                                    <option value="{{$key}}" selected> {{$parent}}</option>
                                    @else
                                    <option value="{{$key}}"> {{$parent}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('parent_id'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group ">
                        <label for="job_description">Job Description</label>
                        <textarea name="job_description" class="form-control">{!! $designation->job_description !!} </textarea>
                        @if ($errors->has('job_description'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('job_description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <label for="responsibilities"> Responsibilities </label>
                        <textarea name="responsibilities" class="form-control"> {!! $designation->responsibilities !!}</textarea>
                        @if ($errors->has('responsibilities'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('responsibilities') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}



