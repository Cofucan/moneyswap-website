<div class="modal fade" id="edit{{$level->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Update Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('levels.update', $level) }}" id="UpdateOutlet">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="form-group">
                        <strong>Program: </strong> {{$level->Program->label}}
                    </div>

                    <div class="form-group">
                        <label for="label" class="control-label">Class Label </label>
                        <input type="text" name="label" value="{{$level->label}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" id="label" placeholder="School Name" required>
                        @if ($errors->has('label'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="parent_id">Child of</label>
                        <select class="custom-select d-block w-100 select2"  name="parent_id" id="parent_id">
                        <option value=""> Select previous level</option>
                            @foreach($levels as $level)
                                @if($level->parent_id == $level->id)
                                <option value="{{$level->id}}" selected> {{$level->label}}</option>
                                @else
                                <option value="{{$level->id}}"> {{$level->label}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('parent_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('parent_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea name="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" placeholder="Enter remark">{{ $level->overview }}
                        </textarea>
                        @if ($errors->has('remarks'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('remarks') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Update </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
