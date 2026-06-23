@if(Auth::user()->role_id == 1 && $volunteer->status == 'Paid')
<form action="{{ route('volunteers.process') }}" method="post"
onsubmit="return confirm('Are you sure you want to Approve this volunteer ?');">                                            
{{ csrf_field() }}
<input type="hidden" name="volunteer_id" value="{{ $volunteer->id}}" />
<button type="submit" name="status" class="btn btn-sm btn-danger action_btn" value="Approved"> Approved</button>                                       
 </form>
 @endif 