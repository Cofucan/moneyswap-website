<a class="btn btn-primary px-3 mb-2 btn-sm" data-toggle="modal" data-target="#reactivate">
    Re-Activate Clients
</a>
        {{-- modal begins--}}
<div class="modal fade" id="reactivate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center">Re-Activate Clients</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('clients.activation') }}" id="BulkActivate">
                    {{csrf_field()}}
                    <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}">
                <div class="form-group mb-2">
                    <label for="grade_id">Select enrolment class </label>
                    <select class="custom-select{{ $errors->has('grade_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="grade_id" id="grade_id">
                       @foreach ($levels as $level)
                        <option value="{{$level->id}}"> {{$level->label}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('grade_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('grade_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Continue </button>
                {{--  <button class="btn btn-primary" type="reset">Reset Form</button>  --}}
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}
