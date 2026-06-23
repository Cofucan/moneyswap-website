
<form action="{{ route('cohorts.process') }}" method="post"
    onsubmit="return confirm('Click ok to approve all Enrolments');">
    {{ csrf_field() }}
    <input type="hidden" name="cohort_id" value="{{ $cohort->id}}" />
    @if(($cohort->status =='Scheduled' || $cohort->status == 'Draft') && (Auth::user()->Profile->role_id == 3 || Auth::user()->Profile->role_id == 11))
    <button type="submit" name="status" class="btn btn-sm btn-success mb-3 btn-block" value="Approved">Approve All</button>
    <button type="submit" name="status" class="btn btn-sm btn-danger mb-3 btn-block" value="Rejected">Reject All</button>

    @elseif(($cohort->status =='Rejected' || $cohort->status == 'Draft') && Auth::id() == $cohort->user_id)
    <button type="submit" name="status" class="btn btn-sm btn-primary mb-3 btn-block" value="Scheduled">Submit</button>
    @endif
</form>

