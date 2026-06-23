

<div class="mb-table d-lg-none">
    <div class="row">
      @foreach ($member->NextofKins as $nextofkin)
        <div class="col-sm-6 mb-3">
          <div class="card">
            <div class="py-3 px-3">
              <strong>Name: {{$nextofkin->Person->full_name}}</strong> <br>
              <strong>Gender:</strong> {{$nextofkin->Person->gender}} <br>
              <strong>Relationship: </strong> {{$nextofkin->Relationship->label}} <br>
              <strong>Email: </strong>{{$nextofkin->email}}<br>
              <strong>Telephone: </strong>{{$nextofkin->telephone}}<br>
              <div class="text-center">
                <form action="{{ route('nextofkins.destroy',$nextofkin->id) }}" method="post"
                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                    <input type="hidden" name="_method" value="DELETE" />
                    {{ csrf_field() }}
                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>                            
      @endforeach
    </div>
  </div>
  <div class="lg-table">
    <table class="table" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Next of Kin</th>
                <th>Gender</th>
                <th>Relationship</th>
                <th>Email</th>
                <th>Telephone</th>
                <th  width="15%">Actions</th>
            </tr>
        </thead>
        <tbody >
            @foreach($member->NextofKins as $nextofkin)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$nextofkin->Person->full_name}}</td>
                <td>{{$nextofkin->Person->gender}}</td>
                <td>{{$nextofkin->Relationship->label}}</td>
                <td>{{$nextofkin->email}}</td>
                <td>{{$nextofkin->telephone}}</td>
                <td>
                    <div class="row no-gutters">
                        
                        <div class="col-md-3">
                            <form action="{{ route('nextofkins.destroy',$nextofkin->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>