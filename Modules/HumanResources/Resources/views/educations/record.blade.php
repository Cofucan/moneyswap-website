 
<div class="table-responsive px-3 py-3">
    <table class="table">
        <thead>
            <tr>
                <th>School </th>
                <th>Qualifiction Obtained</th>
                <th>Date</th>
                @if (Auth::user()->profile_id == $employee->profile_id)
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($employee->Profile->Educations as $education)
            <tr>
                <td>{{$education->Organization->organization_name}}</td>
                <td>{{$education->degree}}</td>
                <td>{{$education->period}}</td>
                @if (Auth::user()->profile_id == $employee->profile_id)
                <td>
                    <div class="row">
                       
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('educations.destroy',$education->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this order?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                       
                    </div>
                </td>
                @endif
            </tr>
       
            @endforeach     
        </tbody>
    </table>
</div>


