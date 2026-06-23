<form action="{{ route('telephones.destroy',$telephone->id) }}" method="post"
    onsubmit="return confirm('Are you sure you want to delete this record?');">
    <input type="hidden" name="_method" value="DELETE" />
    {{ csrf_field() }}
    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
</form>