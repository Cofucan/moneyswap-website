            <td>{{ $loop->iteration }}</td>
            <td>{{ $price->label }}</td>
            <td>{{ $price->Feature->label ?? 'Unassigned' }}</td>
            <td>{{ $price->category ?? 'Uncategorized' }}</td>
            <td>
                @if(is_null($price->cost_price))
                    Free
                @else
                    NGN {{ number_format($price->cost_price, 2) }}
                @endif
            </td>
            <td>
                @if($price->published == true)
                    <span class="badge badge-success">Enabled</span>
                @else
                    <span class="badge badge-secondary">Disabled</span>
                @endif
            </td>
            <td class="text-nowrap">
                <div class="btn-group btn-group-sm" role="group" aria-label="Price actions">
                    <a class="btn btn-outline-primary" href="{{ route('prices.show', $price) }}">Details</a>
                    <a class="btn btn-outline-secondary" href="#editprice{{ $price->id }}" data-toggle="modal" data-target="#editprice{{ $price->id }}">Edit</a>
                    @if($price->published == true)
                        <a class="btn btn-outline-warning" href="{{ url('prices/toggle', $price)}}">Disable</a>
                    @else
                        <a class="btn btn-outline-success" href="{{ url('prices/toggle', $price)}}">Enable</a>
                    @endif
                    <form class="d-inline" action="{{ route('prices.destroy', $price) }}" method="post"
                          onsubmit="return confirm('Are you sure you want to delete this record?');">
                        <input type="hidden" name="_method" value="DELETE" />
                        {{ csrf_field() }}
                        <button type="submit" name="Delete" class="btn btn-outline-danger">Delete</button>
                    </form>
                </div>
                {{-- modal begins--}}
                    @include('catalogmanagement::prices._formedit')
                {{-- modal ends--}}
            </td>
     
