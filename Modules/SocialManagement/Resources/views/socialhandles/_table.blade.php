<table class="table" id="table">
  <thead>
      <tr>
          <th>#</th>
          <th> Social Handle Name </th>
          <th width="18%">Actions</th>
      </tr>
  </thead>
  <tbody>
      @foreach($socialhandles as $socialhandle)
      <tr>
          <td>{{$socialhandle->id}}</td>
          <td> <a href="{{ $socialhandle->SocialPlatform->url }}/{{$socialhandle->handle_name}}" target="_blank"><i class="fa fa-{{ $socialhandle->SocialPlatform->icon }}"></i> {{$socialhandle->handle_name}}  </a> </td>

          <td>
              <div class="row">

                  <div class="col-md-6">
                      <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#edithandle{{$socialhandle->id}}">
                          <i class="fa fa-edit"></i>
                      </button>

                  </div>
                  <div class="col-md-3">
                      <form action="{{ route('socialhandles.destroy',$socialhandle->id) }}" method="post"
                          onsubmit="return confirm('Are you sure you want to delete this record?');">
                          <input type="hidden" name="_method" value="DELETE" />
                          {{ csrf_field() }}
                          <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                      </form>
                  </div>
              </div>
          </td>
          @include('socialmanagement::socialhandles._formedit')
      </tr>
      @endforeach
  </tbody>
</table>
