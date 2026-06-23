                
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$lead->company_name}}</td>
                      <td>{{$lead->contact_name}}</td>
                      <td>{{$lead->Contact->telephone}}</td>
                      <td>{{$lead->Contact->email}}</td>
                      <td>{{$lead->position}}</td>
                      <td>{{$lead->cycle}}</td>
                      <td>
                          <div class="row no-gutters">
                              <div class="col-md-8">
                                <a class="btn btn-primary btn-sm" href="{{ route('leads.show', $lead) }}">Details</a>
                                <a class="btn btn-secondary btn-sm" data-toggle="modal" href="#edit{{$lead->id}}" data-target="#edit{{ $lead->id}}">Edit</a>
                              </div>
                              <div class="col-md-3">
                                  <form action="{{ route('leads.destroy',$lead) }}" method="post"
                                      onsubmit="return confirm('Are you sure you want to delete this record?');">
                                      <input type="hidden" name="_method" value="DELETE" />
                                      {{ csrf_field() }}
                                      <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                  </form>
                              </div>
                          </div>
                        </td>
                  </tr>
                  @include('contactmanagement::leads._modaledit')
                