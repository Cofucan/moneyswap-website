@if($resume->profile_id == Auth::user()->profile_id )
    @if($resume->status == 'Draft' || $resume->status == 'Rejected') 
        <div class="col-md-1 col-sm-3 col-4">    
            <form action="{{ route('resumes.process') }}" method="post"
                onsubmit="return confirm('Are you sure you want to publish this resume?');">
                <input type="hidden" name="resume_id" value="{{ $resume->id}}" />
                {{ csrf_field() }}
            <button type="submit" name="status" value="Moderation" class="btn btn-success btn-sm"><i class="fa fa-play-circle-o"></i> Publish</button>
            </form> 
        </div>    
    @elseif($resume->status == 'Approved')  
        <div class="col-md-1 col-sm-3 col-4">                       
        <a class="btn btn-danger btn-sm" href="{{ url('resumes/toggle', $resume->reference_code)}}"><i class="fa fa-power-off"></i> Unpublish</a>
        </div>    
    @endif 
    @if($resume->status <> 'Moderation')
        <div class="col-md-2 col-sm-3 col-6">
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editresume">
                <i class="fa fa-edit"></i> Edit Resume
            </button>
        </div>
    @endif                  
@endif 
@if (Auth::user()->Profile->Role->role_category_id == 4)
<div class="col-md-2 col-sm-3 col-4">    
    <form action="{{ route('resumes.process') }}" method="post"
        onsubmit="return confirm('Are you sure you want to publish this resume?');">
        <input type="hidden" name="resume_id" value="{{ $resume->id}}" />
        {{ csrf_field() }}
        @if ($resume->status <> 'Approved')
            <button type="submit" name="status" value="Approved" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</button>
            <button type="submit" name="status" value="Rejected" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</button>            
        @endif
    </form> 
</div>
@endif