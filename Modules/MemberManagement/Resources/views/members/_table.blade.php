<table class="table w-100" id="table">
        <thead>
            <tr>
                <th >#</th>

                <th>Client</th>
                <th>Term</th>
                <th>Level</th>
                <th>Updated</th>
                <th>Status</th>
                <th  width="25%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$member->Profile->candidate_name}}</td>
                <td>{{$member->AcademicTerm->academic_term}}</td>
                <td>{{$member->Level->label}}</td>
                <td>{{$member->updated_at}}</td>

                <td>{{$member->status}}</td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-3">
                            <a href="{{ route('members.show', $member->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="col-md-5">
                          @include('members._action')
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
