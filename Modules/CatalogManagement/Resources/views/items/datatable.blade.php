            <td>{{$loop->iteration}}</td>
            <td>{{ $item->label }}</td>
             <td>{{ $item->cost }}</td>
           
            <td>
                @if($item->published == true)
                Enabled
                @else
                Disabled
                @endif           
            </td>
            <td>
                <div class="row">
                    <div class="col-md-2">
                        <a class="btn btn-primary btn-sm px-2" href="{{route('items.show', $item) }}">Details</a>
                    </div>
                  
                        <div class="col-md-7">
                            <a class="btn btn-secondary btn-sm px-2" href="#edititem{{ $item->id }}" data-toggle="modal" data-target="#edititem{{ $item->id }}">Edit</a>
                          
                           
                        </div>
                            <div class="col-md-2">
                                <form action="{{ route('items.destroy',$item) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn px-3"> <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                {{-- modal begins--}}
                    @include('catalogmanagement::items._formedit')
                {{-- modal ends--}}
                </div>
            </td>
     