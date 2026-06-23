    @if( $objection->status == 'Pending'  && Auth::user()->profile->role_id == 1 )
    <form action="{{ route('objections.process') }}" method="POST"
    onsubmit="return confirm('Click OK to confirm and continue ');">
    {{csrf_field()}}
    <input type="hidden" name="objection_id" value="{{ $objection->id }}">
    <div class="form-row mb-3">
        <div class="col-md-7">
            <select name="todo" class="custom-select select2" id="todo" required>
                <option value="">Select Action </option>
                <option value="Acknowledge">Acknowledge </option>
                <option value="Decline">Cancel</option>
            </select>
        </div>
        <div class="col-md-5" >
        <button type="submit" class="btn btn-success btn-block"> Confirm</button>
        </div>
    </div>
    </form>
    @endif
