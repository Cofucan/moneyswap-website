@if(Auth::user()->role_id == 1 && $donor->status == 'Paid')
<form action="{{ route('donors.process') }}" method="post"
onsubmit="return confirm('Are you sure you want to Approve this donor ?');">                                            
{{ csrf_field() }}
<input type="hidden" name="donor_id" value="{{ $donor->id}}" />
<button type="submit" name="status" class="btn btn-sm btn-danger action_btn" value="Approved"> Approved</button>                                       
 </form>
 @endif 