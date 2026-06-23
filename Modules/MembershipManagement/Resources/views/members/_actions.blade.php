<div class="row">
    <div class="col-md-2">
        <a class="btn btn-primary btn-sm" href="{{ route('registrations.show',$employee->id) }}"><i class="fa fa-eye"></i> </a>
    </div>
    @if(Auth::user()->profile->role_id == 14)
    <div class="col-md-7">
        <form action="{{ route('registrations.process') }}" method="post"
            onsubmit="return confirm('Are you sure you want perform the action?');">
            <input type="hidden" name="registration_id" value="{{ $employee->id }}">
            {{ csrf_field() }}
            @if($employee->status == 'Submitted')
            <button type="submit" name="status" value="Paid" class="btn btn-sm btn-success action_btn"> <i class="fa fa-check"></i></button>
            <button type="submit" name="status" value="Rejected" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-times"></i></button>
            @elseif($employee->status == 'Approved')
            <button type="submit" name="status" value="Deactivated" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-power-off"></i> Deactivate</button>
            @elseif($employee->status == 'Deactivated')
            <button type="submit" name="status" value="Approved" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-play-circle"></i> Activate</button>
            @endif
        </form>
    </div>
    @endif
</div>
