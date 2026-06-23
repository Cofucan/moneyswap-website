<div class="table-responsive px-3 py-3">
    <table class="table">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employee->Profile->Employments as $employment)
            <tr>
                <td>{{ $employment->job_title }}</td>
                <td>{{$employment->company}}</td>
                <td>{{$employment->period}}</td>

                <td>
                    <div class="row">
                        <div class="col-md-4">
                            <a class="btn btn-primary btn-sm" data-targethref="#showemployment{{$employment->id}}" data-toggle="modal" data-target="#showemployment{{$employment->id}}">
                                Detail
                            </a>
                        </div>
                        @if (Auth::user()->profile_id == $employee->profile_id)
                        <div class="col-md-4">
                            <a class="btn btn-secondary btn-sm" href="#employment{{$employment->id}}" data-toggle="modal" data-target="#employment{{$employment->id}}">
                               Edit
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('employments.destroy',$employment->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this order?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                        @endif
                    </div>
                </td>
            </tr>
            @include('humanresources::employments.editmodal')
            @include('humanresources::employments.showmodal')
            @endforeach
        </tbody>
    </table>
</div>

