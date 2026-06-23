

    <div class="col-md-4">
        {{-- @if($member->status == 'Offerred' || $member->status == 'Scheduled')
            <a class="btn btn-primary btn-sm" href="{{ route('members.edit',$member) }}">Edit</a>
        @endif  --}}
   
        <form action="{{ route('members.process') }}" method="post"
        onsubmit="return confirm('Are you sure you want to Perform this action?');">
        {{ csrf_field() }}
        <input type="hidden" name="member_id" value="{{ $member->id}}" />
        <!-- <input type="hidden" name="academic_term_id" value="{{ $member->academic_term_id}}" /> -->

        @if(Auth::user()->Profile->role_id == 11)
            @if($member->status == 'Scheduled' || $member->status == 'Accepted')
            <button type="submit" name="status" class="btn btn-sm btn-danger action_btn" value="Approved"> Approve</button>
            @elseif($member->status == 'Approved' || $member->status == 'Accepted')
            <button type="submit" name="status" class="btn btn-sm btn-danger action_btn" value="WithDrawn"> WithDraw</button>
            @endif
        @endif
        </form>
    </div>
    <div class="col-md-1 text-left">
        @if($member->status == 'Recommended')
        <form action="{{ route('members.destroy',$member) }}" method="post"
            onsubmit="return confirm('Are you sure you want to delete this record?');">
            <input type="hidden" name="_method" value="DELETE" />
            {{ csrf_field() }}
            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
        </form>
        @endif
    </div>
