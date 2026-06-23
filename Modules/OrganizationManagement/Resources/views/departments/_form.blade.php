{{-- organization modal begins--}}
<div class="modal fade" id="new-department" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Add New Department</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                                    
                <form method="POST" action="{{ route('departments.store') }}" id="CreateDepartment" >
                    {{csrf_field()}}
                   
                    
                    <div class="form-group">
                        <label for="label"> Department</label>
                        <input type="text" name="label" value="{{old('label')}}" class="form-control {{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter Department Title"  id="label"/>
                        @if ($errors->has('label'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>
                
                
                    <div class="form-group ">
                        <label for="overview">Overview</label>
                        <textarea name="overview" class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}" rows="5">
                            {{old('overview')}}
                        </textarea>
                        @if ($errors->has('overview'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('overview') }}</strong>
                            </span>
                        @endif
                    </div>                       

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save </button>
                      
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}


